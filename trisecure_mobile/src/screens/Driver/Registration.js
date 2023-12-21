import React, { useState, useEffect } from "react";
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  Platform,
  Image,
  ScrollView,
} from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { styles } from "../../styles/Form";
import * as ImagePicker from "expo-image-picker";
import axios from "axios";

const Registration = ({ navigation }) => {
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [address, setAddress] = useState("");
  const [phoneNumber, setPhoneNumber] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [passwordConfirmation, setPasswordConfirmation] = useState("");
  const [error, setError] = useState("");
  const [imageUri, setImageUri] = useState(null);

  const pickImage = async () => {
    let result = await ImagePicker.launchImageLibraryAsync({
      mediaTypes: ImagePicker.MediaTypeOptions.Images,
      allowsEditing: true,
      aspect: [4, 3],
      quality: 1,
    });
    setImageUri(result.assets[0].uri);
  };

  useEffect(() => {
    (async () => {
      if (Platform.OS !== "web") {
        const { status } =
          await ImagePicker.requestMediaLibraryPermissionsAsync();
        if (status !== "granted") {
          alert("Sorry, we need camera roll permissions to make this work!");
        }
      }
    })();

    checkToken();
  }, []);

  const checkToken = async () => {
    const token = await AsyncStorage.getItem("driverToken");
    if (token) {
      navigation.navigate("Driver Tab Navigator", { screen: "Dashboard" });
    }
  };

  const handleRegister = async () => {
    setError("");
    try {
      const formData = new FormData();
      formData.append("first_name", firstName);
      formData.append("last_name", lastName);
      formData.append("address", address);
      formData.append("phone_number", phoneNumber);
      formData.append("email", email);
      formData.append("password", password);
      formData.append("password_confirmation", passwordConfirmation);

      if (imageUri) {
        const uriParts = imageUri.split(".");
        const fileType = uriParts[uriParts.length - 1];

        formData.append("license", {
          uri: imageUri,
          name: `photo.${fileType}`,
          type: `image/${fileType}`,
        });
      }

      const response = await axios.post(
        "http://192.168.42.41:8000/api/drivers/register",
        formData,
        {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        }
      );

      navigation.navigate("Driver Login");
    } catch (error) {
      setError("Invalid credentials");
    }
  };

  return (
    <ScrollView>
      <View style={[styles.container, { flex: 1 }]}>
        <Text style={styles.title}>Hello!</Text>
        <Text style={styles.description}>Create a new account.</Text>
        {error !== "" && (
          <Text style={[styles.description, { color: "red" }]}>{error}</Text>
        )}
        <TouchableOpacity
          style={[styles.inputButton, { marginBottom: 10 }]}
          onPress={pickImage}
        >
          <Text style={styles.inputButtonText}>Add License</Text>
        </TouchableOpacity>
        {imageUri && (
          <Image
            source={{ uri: imageUri }}
            style={{ width: 200, height: 200, marginBottom: 10 }}
          />
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
        <TextInput
          style={styles.input}
          placeholder="Password"
          value={password}
          onChangeText={(text) => setPassword(text)}
          secureTextEntry
        />
        <TextInput
          style={styles.input}
          placeholder="Confirm Password"
          value={passwordConfirmation}
          onChangeText={(text) => setPasswordConfirmation(text)}
          secureTextEntry
        />
        <TouchableOpacity style={styles.inputButton} onPress={handleRegister}>
          <Text style={styles.inputButtonText}>Register</Text>
        </TouchableOpacity>
        <Text style={styles.inputText}>
          Already have an account?{" "}
          <Text
            style={styles.subInputText}
            onPress={() => navigation.navigate("Driver Login")}
          >
            Login
          </Text>
        </Text>
      </View>
    </ScrollView>
  );
};

export default Registration;
