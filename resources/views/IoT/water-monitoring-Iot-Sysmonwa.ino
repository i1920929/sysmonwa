#include <WiFi.h>          // Biblioteca Wi-Fi para ESP32
#include <SPI.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <HTTPClient.h>     // Biblioteca HTTP para ESP32
#include <Preferences.h>    // Biblioteca para usar la EEPROM en ESP32

//Define pins
#define I2C_A_SDA 38 // GPIO8
#define I2C_A_SCL 37 // GPIO9

// OLED parameters
#define SCREEN_WIDTH 128     // OLED display width, in pixels
#define SCREEN_HEIGHT 64     // OLED display height, in pixels
#define OLED_RESET -1        // Reset pin # (or -1 if sharing Arduino reset pin)
#define SCREEN_ADDRESS 0x3C  // Change if required
#define ROTATION 0           // Rotates text on OLED 1=90 degrees, 2=180 degrees

// Define display object
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);

// Configuración de Wi-Fi
const char *ssid = "CARDENAS-2.4G";
const char *password = "41149860";
const char* server = "https://developysa.alwaysdata.net/insertar.php";

// Definir pines del sensor y LED
#define LED_BUILTIN 5
#define SENSOR 42

// Variables de flujo
long currentMillis = 0;
long previousMillis = 0;
int interval = 1000;
float calibrationFactor = 4.5;
volatile byte pulseCount;
byte pulse1Sec = 0;
float flowRate;
unsigned long flowMilliLitres;
unsigned int totalMilliLitres;
float flowLitres;
float totalLitres;
float previous_consumption_volume = 0.0;

//datos sensor ultrasonico 
int trig = 40;     //Transmisor
int eco = 41;      //Receptor
int duracion;     //Variable para duracion del pulso
int distancia;    //Variable para hallar la distancia

// Inicializar EEPROM con Preferences
Preferences preferences;

// Función de interrupción para contar pulsos del sensor
void IRAM_ATTR pulseCounter() {
  pulseCount++;
}

// Función para almacenar los datos en EEPROM
void storeInEEPROM() {
  preferences.putFloat("totalLitres", totalLitres);
  preferences.putFloat("flowRate", flowRate);
}

// Función para leer los datos desde EEPROM
void loadFromEEPROM() {
  totalLitres = preferences.getFloat("totalLitres", 0.0);  // Valor predeterminado: 0.0
  flowRate = preferences.getFloat("flowRate", 0.0);        // Valor predeterminado: 0.0
}

WiFiClient client;

void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  delay(2000);
  Serial.println(String("Conectando a ") + ssid);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConectado, IP address: ");
  Serial.println(WiFi.localIP());
  Serial.println("Conexión realizada");

  // Inicializar EEPROM
  preferences.begin("water_flow", false);
  loadFromEEPROM();

  // Inicializar OLED
  Wire.begin(I2C_A_SDA, I2C_A_SCL);
  if (!display.begin(SSD1306_SWITCHCAPVCC, SCREEN_ADDRESS)) {
    Serial.println(F("Falló la inicialización del OLED"));
    for (;;);
  }
  display.clearDisplay();
  delay(10);

  pinMode(LED_BUILTIN, OUTPUT);
  pinMode(SENSOR, INPUT_PULLUP);
  pulseCount = 0;
  previousMillis = 0;

  attachInterrupt(digitalPinToInterrupt(SENSOR), pulseCounter, FALLING);
  pinMode(trig, OUTPUT);
  pinMode(eco, INPUT);
}

void loop() {

  //Enviamos el pulso
  digitalWrite(trig, HIGH);
  delay(1);
  digitalWrite(trig, LOW);

  duracion = pulseIn(eco, HIGH);  //Recibe el puslo
  distancia = duracion / 58;    //Calculo para hallar la distancia en cm

   Serial.print("el nivel de agua es: ");
    Serial.print(distancia);
    Serial.print("cm");
    Serial.print("\t");

    if (distancia < 10) {
    digitalWrite(LED_BUILTIN, HIGH);
  } 
  //Si la distancia es mayor a 20 apagamos el led
  else {
    digitalWrite(LED_BUILTIN, LOW);
  }
  delay(500);

  currentMillis = millis();
  if (currentMillis - previousMillis > interval) {
    pulse1Sec = pulseCount;
    pulseCount = 0;

    flowRate = ((1000.0 / (millis() - previousMillis)) * pulse1Sec) / calibrationFactor;
    previousMillis = millis();

    flowMilliLitres = (flowRate / 60) * 1000;
    flowLitres = (flowRate / 60);
    totalMilliLitres += flowMilliLitres;
    totalLitres += flowLitres;

    Serial.print("Flow rate: ");
    Serial.print(float(flowRate));
    Serial.print("L/min");
    Serial.print("\t");

    display.clearDisplay();
    display.setCursor(10, 0);
    display.setTextSize(1);
    display.setTextColor(WHITE);
    display.print("Water Flow Meter");

    display.setCursor(0, 20);
    display.setTextSize(2);
    display.setTextColor(WHITE);
    display.print("R:");
    display.print(float(flowRate));
    display.setCursor(100, 28);
    display.setTextSize(1);
    display.print("L/M");

    Serial.print("Output Liquid Quantity: ");
    Serial.print(totalMilliLitres);
    Serial.print("mL / ");
    Serial.print(totalLitres);
    Serial.println("L");

    display.setCursor(0, 45);
    display.setTextSize(2);
    display.setTextColor(WHITE);
    display.print("V:");
    display.print(totalLitres);
    display.setCursor(100, 53);
    display.setTextSize(1);
    display.print("L");
    display.display();
    
    storeInEEPROM();  // Guardar datos en EEPROM
  }

  if (WiFi.status() == WL_CONNECTED) {
    if (totalLitres != previous_consumption_volume || flowRate == 0) {
      HTTPClient http;
      http.begin(server);
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");

      String httpRequestData = "consumption_volume=" + String(totalLitres) +
                               "&sensor_id=" + String("1") +
                               "&tank_id=" + String("1") +
                               "&client_id=" + String("1") +
                               "&flow_rate=" + String(flowRate);

      int httpResponseCode = http.POST(httpRequestData);

      if (httpResponseCode > 0) {
        String response = http.getString();
        Serial.println(httpResponseCode);
        Serial.println(response);
      } else {
        Serial.println("Error en la solicitud POST");
      }

      http.end();
      previous_consumption_volume = totalLitres;
    }
  }
}
