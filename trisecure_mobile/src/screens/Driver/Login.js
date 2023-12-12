import React, { useState, useEffect } from "react";
import { View, Text, TextInput, TouchableOpacity } from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { styles } from "../../styles/Form";
import axios from "axios";

const Login = ({ navigation }) => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");

  useEffect(() => {
    checkToken();
  }, []);

  const checkToken = async () => {
    const token = await AsyncStorage.getItem("driverToken");
    if (token) {
      navigation.navigate("Driver Tab Navigator", { screen: "Dashboard" });
    }
  };

  const handleLogin = async () => {
    setError("");
    try {
      const response = await axios.post(
        "http://192.168.1.7:8000/api/drivers/login",
        {
          email,
          password,
        }
      );
      if (response.data.message === "Your account is pending") {
        navigation.navigate("Driver Account Pending");
      } else {
        const { token, user } = response.data.response;

        await AsyncStorage.setItem("driverToken", token);
        await AsyncStorage.setItem("driverData", JSON.stringify(user));

        setEmail("");
        setPassword("");
        navigation.navigate("Driver Tab Navigator", { screen: "Dashboard" });
      }
    } catch (error) {
      setEmail("");
      setPassword("");
      setError(error.response.data.message);
    }
  };
  return (
    <>
      <View style={[styles.container, { flex: 1 }]}>
        <Text style={styles.title}>Welcome Driver!</Text>
        <Text style={styles.description}>Sign in to continue.</Text>
        {error !== "" && (
          <Text style={[styles.description, { color: "red" }]}>{error}</Text>
        )}
        <TextInput
          style={styles.input}
          placeholder="Email"
          value={email}
          onChangeText={(text) => setEmail(text)}
        />
        <TextInput
          style={styles.input}
          placeholder="Password"
          secureTextEntry
          value={password}
          onChangeText={(text) => setPassword(text)}
        />
        <TouchableOpacity style={styles.inputButton} onPress={handleLogin}>
          <Text style={styles.inputButtonText}>Login</Text>
        </TouchableOpacity>
        <Text style={styles.inputText}>
          Don't have an Account?{" "}
          <Text
            style={styles.subInputText}
            onPress={() => navigation.navigate("Driver Registration")}
          >
            Register
          </Text>
        </Text>
      </View>
    </>
  );
};

export default Login;
