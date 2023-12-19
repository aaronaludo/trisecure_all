import React, { useState, useEffect } from "react";
import { styles } from "../../styles/Box";
import { View, Text } from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import axios from "axios";

const ViewRideHistory = ({ route }) => {
  const { history_id } = route.params;
  const [history, setHistory] = useState({
    driver: {
      first_name: "",
      last_name: "",
      phone_number: "",
      email: "",
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
  }, []);

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
            Ride date:{" "}
            {new Date(history.created_at).toLocaleDateString("en-US")}
          </Text>
        </View>
      )}
    </View>
  );
};

export default ViewRideHistory;
