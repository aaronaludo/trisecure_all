import React, { useState, useEffect } from "react";
import { View, Text, TextInput, TouchableOpacity } from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { styles } from "../../styles/Form";
import axios from "axios";

const AccountInformation = ({ navigation }) => {
  const [driverId, setDriverId] = useState("");
  const [statusId, setStatusId] = useState("");
  const [qrCode, setQrCode] = useState("");
  const [license, setLicense] = useState(null);
  const [error, setError] = useState("");

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
          placeholder="Driver "
          value={firstName}
          onChangeText={(text) => setFirstName(text)}
        />
        <TouchableOpacity style={styles.inputButton} onPress={handleSubmit}>
          <Text style={styles.inputButtonText}>Submit</Text>
        </TouchableOpacity>
      </View>
    </>
  );
};

export default AccountInformation;
