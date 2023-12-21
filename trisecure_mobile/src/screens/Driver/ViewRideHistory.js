import React, { useState, useEffect } from "react";
import { styles } from "../../styles/Box";
import { View, Text } from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import axios from "axios";
import moment from "moment";

const ViewRideHistory = ({ route }) => {
  const { history_id } = route.params;
  const [history, setHistory] = useState({
    passenger: {
      first_name: "",
      last_name: "",
      phone_number: "",
      email: "",
      address: "",
    },
    status: {
      id: 0,
    },
  });
  console.log(history);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const token = await AsyncStorage.getItem("driverToken");

        const response = await axios.get(
          `http://192.168.42.41:8000/api/drivers/ride-histories/${history_id}`,
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
  }, []);

  return (
    <View style={styles.container}>
      {history && (
        <View>
          <Text style={styles.title}>
            Passenger name: {history.passenger.first_name}{" "}
            {history.passenger.last_name}
          </Text>
          <Text style={styles.title}>
            Passenger phone: {history.passenger.phone_number}
          </Text>
          <Text style={styles.title}>
            Passenger email: {history.passenger.email}
          </Text>
          <Text style={styles.title}>
            Passenger address: {history.passenger.address}
          </Text>
          <Text style={styles.title}>
            Ride date: {moment(history.created_at).format("MM/DD/YYYY hh:mm A")}
          </Text>
          {history.status.id == 4 && (
            <Text style={styles.title}>
              Dropoff Date:
              {moment(history.updated_at).format("MM/DD/YYYY hh:mm A")}
            </Text>
          )}
        </View>
      )}
    </View>
  );
};

export default ViewRideHistory;
