
#include <OneWire.h>
#include <DallasTemperature.h>
// Data wire is conntec to the Arduino digital pin 4
#define ONE_WIRE_BUS 23
// Setup a oneWire instance to communicate with any OneWire devices
OneWire oneWire(ONE_WIRE_BUS);
// Pass our oneWire reference to Dallas Temperature sensor
DallasTemperature sensors(&oneWire);


void setup(void) {
  // Start serial communication for debugging purposes
  Serial.begin(9600);  // initialize the Serial Monitor at a baud rate of 9600
  // Start up the library
  sensors.begin();  // initialize the DS18B20 temperature sensor:
}
void loop(void) {
  // Call sensors.requestTemperatures() to issue a global temperature and Requests to all devices on the bus
  sensors.requestTemperatures();
  Serial.print("Celsius temperature: ");
  // Why "byIndex"? You can have more than one IC on the same bus. 0 refers to the first IC on the wire
  Serial.println(getTemp());
}

