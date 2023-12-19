import React from "react";
import { Text, TouchableOpacity } from "react-native";
import { createBottomTabNavigator } from "@react-navigation/bottom-tabs";
import Dashboard from "../screens/Passenger/Dashboard";
import QrScanner from "../screens/Passenger/QrScanner";
import Notification from "../screens/Passenger/Notification";
import { Feather } from "@expo/vector-icons";

const Tab = createBottomTabNavigator();

export default function App({ navigation }) {
  return (
    <Tab.Navigator
      screenOptions={({ route }) => ({
        headerRight: () => (
          <TouchableOpacity
            onPress={() => navigation.navigate("Passenger Account")}
            style={{ marginRight: 15 }}
          >
            <Feather name="user" size={24} color="black" />
          </TouchableOpacity>
        ),
        tabBarActiveTintColor: "#0d6efd",
      })}
    >
      <Tab.Screen
        name="Dashboard"
        component={Dashboard}
        options={{
          tabBarIcon: ({ color, size, focused }) => (
            <Feather
              name="home"
              size={24}
              color={focused ? "#0d6efd" : "grey"}
            />
          ),
        }}
      />
      <Tab.Screen
        name="Qr Scanner"
        component={QrScanner}
        options={{
          tabBarIcon: ({ color, size, focused }) => (
            <Feather
              name="camera"
              size={24}
              color={focused ? "#0d6efd" : "grey"}
            />
          ),
        }}
      />
      <Tab.Screen
        name="Notification"
        component={Notification}
        options={{
          tabBarIcon: ({ color, size, focused }) => (
            <Feather
              name="bell"
              size={24}
              color={focused ? "#0d6efd" : "grey"}
            />
          ),
        }}
      />
    </Tab.Navigator>
  );
}
