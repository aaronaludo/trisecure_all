import React, { useState, useEffect } from "react";
import Box from "../../components/Box";
import { styles } from "../../styles/Box";
import {
  ScrollView,
  StyleSheet,
  View,
  Text,
  TouchableOpacity,
} from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import axios from "axios";

const Dashboard = ({ navigation }) => {
  const [userData, setUserData] = useState({
    id: null,
    first_name: "",
    last_name: "",
    email: "",
    phone_number: "",
    address: "",
    role_id: null,
    status_id: null,
    created_at: null,
    updated_at: null,
  });
  const [histories, setHistories] = useState([]);
  const [refresh, setRefresh] = useState(0);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const token = await AsyncStorage.getItem("driverToken");

        const response = await axios.get(
          "http://192.168.1.2:8000/api/drivers/ride-histories",
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );

        setHistories(response.data.histories);
      } catch (error) {
        console.log(error);
      }
    };

    fetchData();
    getUserData();
  }, [refresh]);

  const getUserData = async () => {
    try {
      const storedUserData = await AsyncStorage.getItem("driverData");
      if (storedUserData) {
        const parsedUserData = JSON.parse(storedUserData);
        setUserData(parsedUserData);
      }
    } catch (error) {
      console.error("Error retrieving user data:", error);
    }
  };

  const handleRefresh = () => {
    const randomNumber = Math.floor(Math.random() * 100000) + 1;
    setRefresh(randomNumber);
  };

  return (
    <ScrollView>
      <Box
        container={styles.container}
        title={styles.title}
        description={styles.description}
        titleLabel="Welcome, Driver"
        descriptionLabel={`${userData.email}`}
      />
      <View style={styles.container}>
        <Text style={styles.title}>Ride Histories</Text>
        <Text style={styles.description}>
          Lorem Ipsum has been the industry's standard dummy text ever since the
          1500s.
        </Text>
        <TouchableOpacity
          style={styles.buttonContainer}
          onPress={handleRefresh}
        >
          <Text style={styles.buttonText}>Refresh</Text>
        </TouchableOpacity>
      </View>
      <View style={styles2.table}>
        <View style={styles2.headerRow}>
          <Text style={styles2.headerCell}>ID</Text>
          <Text style={styles2.headerCell}>Passenger Name</Text>
          <Text style={styles2.headerCell}>Status</Text>
          <Text style={styles2.headerCell}>Ride Date</Text>
          <Text style={styles2.headerCell}>Actions</Text>
        </View>
        {histories.map((item) => (
          <View style={styles2.row} key={item.id}>
            <Text style={styles2.cell}>{item.id}</Text>
            <Text style={styles2.cell}>
              {item.passenger.first_name} {item.passenger.last_name}
            </Text>
            <Text style={styles2.cell}>{item.status.name}</Text>
            <Text style={styles2.cell}>
              {new Date(item.created_at).toLocaleDateString("en-US")}
            </Text>
            <View style={styles2.cell}>
              <TouchableOpacity
                style={styles2.button}
                onPress={() =>
                  navigation.navigate("Driver View Ride History", {
                    history_id: item.id,
                  })
                }
              >
                <Text style={styles2.buttonText}>View</Text>
              </TouchableOpacity>
            </View>
          </View>
        ))}
      </View>
    </ScrollView>
  );
};

const styles2 = StyleSheet.create({
  input: {
    width: "100%",
    height: 40,
    marginBottom: 10,
    paddingLeft: 15,
    paddingRight: 15,
    backgroundColor: "#fff",
    borderRadius: 10,
    // shadowColor: "#000",
    // shadowOffset: {
    //   width: 0,
    //   height: 2,
    // },
    // shadowOpacity: 0.25,
    // shadowRadius: 3.84,
    // elevation: 5,
    borderWidth: 1,
    borderBlockColor: "#d0d4dc",
  },
  table: {
    backgroundColor: "#fff",
    borderRadius: 10,
    // margin: 10,
    shadowColor: "#000",
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,
    marginLeft: 20,
    marginRight: 20,
  },
  headerRow: {
    flexDirection: "row",
    backgroundColor: "#f0f0f0",
    padding: 10,
    backgroundColor: "#fffcfc",
  },
  row: {
    flexDirection: "row",
    padding: 10,
  },
  headerCell: {
    flex: 1,
    fontWeight: "bold",
  },
  cell: {
    flex: 1,
  },
  button: {
    marginBottom: 6,
    backgroundColor: "#3498db",
    padding: 8,
    borderRadius: 5,
  },
  buttonText: {
    color: "#fff",
    textAlign: "center",
  },
});

export default Dashboard;
