import * as React from "react";
import { NavigationContainer } from "@react-navigation/native";
import { createStackNavigator } from "@react-navigation/stack";
import PickRole from "./src/screens/PickRole";

import PassengerTabNavigator from "./src/navigator/PassengerTabNavigator";
import PassengerLogin from "./src/screens/Passenger/Login";
import PassengerRegistration from "./src/screens/Passenger/Registration";
import PassengerDashboard from "./src/screens/Passenger/Dashboard";
import PassengerAccount from "./src/screens/Passenger/Account";
import PassengerChangePassword from "./src/screens/Passenger/ChangePassword";
import PassengerAccountInformation from "./src/screens/Passenger/AccountInformation";
import PassengerNotification from "./src/screens/Passenger/Notification";

import DriverTabNavigator from "./src/navigator/DriverTabNavigator";
import DriverLogin from "./src/screens/Driver/Login";
import DriverRegistration from "./src/screens/Driver/Registration";
import DriverDashboard from "./src/screens/Driver/Dashboard";
import DriverAccount from "./src/screens/Driver/Account";
import DriverChangePassword from "./src/screens/Driver/ChangePassword";
import DriverAccountInformation from "./src/screens/Driver/AccountInformation";
import DriverNotification from "./src/screens/Driver/Notification";
import DriverAccountPending from "./src/screens/Driver/AccountPending";

const Stack = createStackNavigator();

function AppNavigator() {
  return (
    <NavigationContainer>
      <Stack.Navigator>
        <Stack.Screen
          name="Pick Role"
          component={PickRole}
          options={{ headerShown: false }}
        />
        {/* Passenger */}
        <Stack.Screen
          name="Passenger Tab Navigator"
          component={PassengerTabNavigator}
          options={{ headerShown: false }}
        />
        <Stack.Screen name="Passenger Login" component={PassengerLogin} />
        <Stack.Screen
          name="Passenger Registration"
          component={PassengerRegistration}
        />
        <Stack.Screen
          name="Passenger Dashboard"
          component={PassengerDashboard}
        />
        <Stack.Screen name="Passenger Account" component={PassengerAccount} />
        <Stack.Screen
          name="Passenger Change Password"
          component={PassengerChangePassword}
        />
        <Stack.Screen
          name="Passenger Account Information"
          component={PassengerAccountInformation}
        />
        <Stack.Screen
          name="Passenger Notification"
          component={PassengerNotification}
        />
        {/* Driver */}
        <Stack.Screen
          name="Driver Tab Navigator"
          component={DriverTabNavigator}
          options={{ headerShown: false }}
        />
        <Stack.Screen name="Driver Login" component={DriverLogin} />
        <Stack.Screen
          name="Driver Registration"
          component={DriverRegistration}
        />
        <Stack.Screen
          name="Driver Account Pending"
          component={DriverAccountPending}
        />
        <Stack.Screen name="Driver Dashboard" component={DriverDashboard} />
        <Stack.Screen name="Driver Account" component={DriverAccount} />
        <Stack.Screen
          name="Driver Change Password"
          component={DriverChangePassword}
        />
        <Stack.Screen
          name="Driver Account Information"
          component={DriverAccountInformation}
        />
        <Stack.Screen
          name="Driver Notification"
          component={DriverNotification}
        />
      </Stack.Navigator>
    </NavigationContainer>
  );
}

export default AppNavigator;
