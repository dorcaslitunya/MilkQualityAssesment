int sensorPin = 34;
int sensorData;

void setup() {
  Serial.begin(9600);
  pinMode(sensorPin, INPUT);
}

void loop() {
  Serial.println(MQValue());
  delay(100);
}