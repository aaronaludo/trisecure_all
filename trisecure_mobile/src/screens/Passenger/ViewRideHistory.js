import React, { useState, useEffect } from "react";
import { styles } from "../../styles/Box";
import { View, Text, TouchableOpacity } from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import axios from "axios";
import moment from "moment";

const ViewRideHistory = ({ route }) => {
  const { history_id } = route.params;
  const [render, setRender] = useState(null);
  const [history, setHistory] = useState({
    driver: {
      first_name: "",
      last_name: "",
      phone_number: "",
      email: "",
    },
    status: {
      name: "",
    },
  });

  useEffect(() => {
    const fetchData = async () => {
      try {
        const token = await AsyncStorage.getItem("passengerToken");

        const response = await axios.get(
          `http://192.168.1.2:8000/api/passengers/ride-histories/${history_id}`,
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        // console.log(response.data.history);
        setHistory(response.data.history);
      } catch (error) {
        console.log(error);
      }
    };

    fetchData();
  }, [render]);

  const handleDropoff = async (id) => {
    try {
      const token = await AsyncStorage.getItem("passengerToken");

      const response = await axios.post(
        `http://192.168.1.2:8000/api/passengers/ride-histories/status`,
        {
          id: id,
        },
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );

      setRender(response);
    } catch (error) {
      console.log(error);
    }
  };

  return (
    <View style={styles.container}>
      {history && (
        <View>
          <Text style={styles.title}>
            Driver name: {history.driver.first_name} {history.driver.last_name}
          </Text>
          <Text style={styles.title}>
            Driver phone: {history.driver.phone_number}
          </Text>
          <Text style={styles.title}>Driver email: {history.driver.email}</Text>
          <Text style={styles.title}>
            Driver address: {history.driver.address}
          </Text>
          <Text style={styles.title}>Status: {history.status.name}</Text>
          <Text style={styles.title}>
            Ride date: {moment(history.created_at).format("MM/DD/YYYY hh:mm A")}
          </Text>
          {history.status.id === 4 ? (
            <Text style={styles.title}>
              Dropoff Date:
              {moment(history.updated_at).format("MM/DD/YYYY hh:mm A")}
            </Text>
          ) : (
            <TouchableOpacity
              style={styles.buttonContainer}
              onPress={() => handleDropoff(history.id)}
            >
              <Text style={styles.buttonText}>Dropoff</Text>
            </TouchableOpacity>
          )}
        </View>
      )}
    </View>
  );
};

export default ViewRideHistory;
