import React, { useState, useEffect } from "react";
import { Text, View, StyleSheet, Button } from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { BarCodeScanner } from "expo-barcode-scanner";
import axios from "axios";

const QrScanner = ({ navigation }) => {
  const [hasPermission, setHasPermission] = useState(null);
  const [scanned, setScanned] = useState(false);
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [address, setAddress] = useState("");
  const [phoneNumber, setPhoneNumber] = useState("");
  const [email, setEmail] = useState("");

  useEffect(() => {
    (async () => {
      const { status } = await BarCodeScanner.requestPermissionsAsync();
      setHasPermission(status === "granted");
    })();
  }, [scanned]);

  const handleBarCodeScanned = async ({ type, data }) => {
    setScanned(true);
    setFirstName("");
    setLastName("");
    setAddress("");
    setPhoneNumber("");
    setEmail("");

    try {
      const token = await AsyncStorage.getItem("passengerToken");
      if (token) {
        const response = await axios.get(
          `http://192.168.1.2:8000/api/passengers/qr-code/${data}`,
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        setFirstName(response.data.user.first_name);
        setLastName(response.data.user.last_name);
        setAddress(response.data.user.address);
        setPhoneNumber(response.data.user.phone_number);
        setEmail(response.data.user.email);
      } else {
        console.error("No authentication token found");
      }
    } catch (error) {
      console.error(error);
    }
  };

  const handleRemove = () => {
    setHasPermission(null);
    setScanned(false);

    navigation.navigate("Passenger Tab Navigator", {
      screen: "Dashboard",
    });
  };

  if (hasPermission === null) {
    return <Text>Requesting camera permission</Text>;
  }
  if (hasPermission === false) {
    return <Text>No access to camera</Text>;
  }

  return (
    <View style={{ flex: 1 }}>
      <BarCodeScanner
        onBarCodeScanned={scanned ? undefined : handleBarCodeScanned}
        style={StyleSheet.absoluteFillObject}
      />
      {scanned && (
        <View style={styles.scanOverlay}>
          <Text style={styles.scanOverlayText}>
            {firstName} {lastName}
          </Text>
          <Text style={styles.scanOverlayText}>{address}</Text>
          <Text style={styles.scanOverlayText}>{phoneNumber}</Text>
          <Text style={styles.scanOverlayText}>{email}</Text>
          <Button title="Done" onPress={handleRemove} />
        </View>
      )}
    </View>
  );
};

const styles = StyleSheet.create({
  scanOverlay: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    backgroundColor: "rgba(0, 0, 0, 0.5)",
  },
  scanOverlayText: {
    color: "white",
    fontSize: 18,
  },
});

export default QrScanner;
