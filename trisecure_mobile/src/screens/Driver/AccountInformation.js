import React, { useState, useEffect } from "react";
import { View, Text, TextInput, TouchableOpacity } from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { styles } from "../../styles/Form";
import axios from "axios";

const AccountInformation = ({ navigation }) => {
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [address, setAddress] = useState("");
  const [phoneNumber, setPhoneNumber] = useState("");
  const [email, setEmail] = useState("");
  const [error, setError] = useState("");

  useEffect(() => {
    getUserData();
  }, []);

  const getUserData = async () => {
    try {
      const storedUserData = await AsyncStorage.getItem("driverData");
      if (storedUserData) {
        const parsedUserData = JSON.parse(storedUserData);
        setFirstName(parsedUserData.first_name);
        setLastName(parsedUserData.last_name);
        setAddress(parsedUserData.address);
        setPhoneNumber(parsedUserData.phone_number);
        setEmail(parsedUserData.email);
      }
    } catch (error) {
      console.error("Error retrieving user data:", error);
    }
  };

  const handleSubmit = async () => {
    setError("");
    try {
      const token = await AsyncStorage.getItem("driverToken");

      const response = await axios.post(
        "http://192.168.42.41:8000/api/drivers/edit-profile",
        {
          first_name: firstName,
          last_name: lastName,
          address: address,
          phone_number: phoneNumber,
          email: email,
        },
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );
      await AsyncStorage.setItem(
        "driverData",
        JSON.stringify(response.data.user)
      );
      navigation.navigate("Driver Tab Navigator", { screen: "Dashboard" });
    } catch (error) {
      setError("Invalid credentials");
    }
  };

  return (
    <>
      <View style={styles.container}>
        <Text style={styles.title}>Welcome!</Text>
        <Text style={styles.description}>Fill your personal details.</Text>
        {error !== "" && (
          <Text style={[styles.description, { color: "red" }]}>{error}</Text>
        )}
        <TextInput
          style={styles.input}
          placeholder="First name"
          value={firstName}
          onChangeText={(text) => setFirstName(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Last name"
          value={lastName}
          onChangeText={(text) => setLastName(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Address"
          value={address}
          onChangeText={(text) => setAddress(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Phone Number"
          value={phoneNumber}
          onChangeText={(text) => setPhoneNumber(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Email"
          value={email}
          onChangeText={(text) => setEmail(text)}
        />
        <TouchableOpacity style={styles.inputButton} onPress={handleSubmit}>
          <Text style={styles.inputButtonText}>Submit</Text>
        </TouchableOpacity>
      </View>
    </>
  );
};

export default AccountInformation;
