// Include the required libraries
#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

// Define the pins for SPI communication
#define RST_PIN 0
#define SS_PIN 4

// Create an instance of the MFRC522 class
MFRC522 mfrc522(SS_PIN, RST_PIN);

// Initialize the WiFi connection
const char* ssid = "UDINUS-connect"; // your WiFi network name
const char* password = "fafajambul2001"; // your WiFi network password
byte readcard[4];
char str[32] = "";
String StrUID;

void setup() {
  // Initialize the serial monitor
  Serial.begin(9600);
  // Initialize the SPI bus
  SPI.begin();
  // Initialize the MFRC522 module
  mfrc522.PCD_Init();
  // Print a message to indicate that the module is ready
  Serial.println("Scan a RFID tag");
  // Connect to the WiFi network
  WiFi.begin(ssid, password);
  // Wait until the connection is established
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  // Print the IP address of the board
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  // Check if a new card is present
  if (mfrc522.PICC_IsNewCardPresent()) {
    // Check if the card is readable
    if (mfrc522.PICC_ReadCardSerial()) {
      // Print the UID of the card
      Serial.print("UID: ");
      for (int i = 0; i < 4; i++) {
        readcard[i] = mfrc522.uid.uidByte[i]; //storing the UID of the tag in readcard
        array_to_string(readcard, 4, str);
        StrUID = str;
      }
      // Halt the card
      mfrc522.PICC_HaltA();
      // Stop encryption on the card
      mfrc522.PCD_StopCrypto1();
    }
      Serial.println(StrUID);
     //  Sending data
      WiFiClient wClient;
      String url;
      HTTPClient http;
      url = "http://192.168.214.166/getrfid/" + StrUID;

     //  Execute URL
      http.begin(wClient, url);
      int httpCode = http.GET();
      Serial.println(httpCode);
      http.end();
  }
}

void array_to_string(byte array[], unsigned int len, char buffer[]) {
  for (unsigned int i = 0; i < len; i++)
  {
    byte nib1 = (array[i] >> 4) & 0x0F;
    byte nib2 = (array[i] >> 0) & 0x0F;
    buffer[i * 2 + 0] = nib1  < 0xA ? '0' + nib1  : 'A' + nib1  - 0xA;
    buffer[i * 2 + 1] = nib2  < 0xA ? '0' + nib2  : 'A' + nib2  - 0xA;
  }
  buffer[len * 2] = '\0';
}