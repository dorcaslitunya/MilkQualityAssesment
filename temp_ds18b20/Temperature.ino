float getTemp() {
  float temp = sensors.getTempCByIndex(0);  // get and print the temperature in degree Celsius
  delay(1000);

  return temp;
}