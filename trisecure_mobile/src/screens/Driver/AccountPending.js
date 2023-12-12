import React from "react";
import Box from "../../components/Box";
import { styles } from "../../styles/Box";
import { ScrollView } from "react-native";
import { Text, View, TouchableOpacity } from "react-native";

const AccountPending = ({ navigation }) => {
  return (
    <Box
      container={styles.container}
      title={styles.title}
      description={styles.description}
      titleLabel="Your account is pending"
      descriptionLabel="wait for the admin to verify your account."
      navigation={navigation}
      buttonContainer={styles.buttonContainer}
      buttonText={styles.buttonText}
      buttonTextLabel={"Back to login"}
      buttonNavigation={"Driver Login"}
    />
  );
};

export default AccountPending;
