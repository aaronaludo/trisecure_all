import React, { useState, useEffect } from "react";
import { View, Image, StyleSheet } from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import QRCode from "react-native-qrcode-svg";

const QrCode = () => {
  const [qrCode, setQrCode] = useState("_");

  useEffect(() => {
    getUserData();
  }, []);

  const getUserData = async () => {
    try {
      const storedUserData = await AsyncStorage.getItem("driverData");
      if (storedUserData) {
        const parsedUserData = JSON.parse(storedUserData);
        setQrCode(parsedUserData.driver_information.qr_code);
      }
    } catch (error) {
      console.error("Error retrieving user data:", error);
    }
  };

  return (
    <View style={styles.container}>
      <QRCode value={qrCode} size={200} />
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: "center",
    justifyContent: "center",
  },
});

export default QrCode;
