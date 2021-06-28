#include <SoftwareSerial.h>
#include <Sim800l.h>
#include <stdlib.h>
#include <DHT.h> // sensor DHT 11 Temp & Kelembaban
#include <Wire.h> 
#include <LiquidCrystal_I2C.h>
#include <L298N.h> //Menyertakan library DRIVER MOTOR L298N
Sim800l Sim800l;  //to declare the library
LiquidCrystal_I2C lcd(0x3F,20,4);//Ukuran LCD


#define DHTPIN1            A0 // Pin temp 1
#define DHTTYPE           DHT11  

DHT dht11(DHTPIN1, DHTTYPE);

char* text;
char* number;
bool sms; //to catch the response of sendSms
int notsms;
int notsms1;
//============variable
int temp;
int hum;
char ket;
int error;
int fan;
//inisialisasi pin yang digunakan
const int EN_A = 0;
const int IN_1 = 4;
const int IN_2 = 3;
const int IN_3 = 6;
const int IN_4 = 5;
const int EN_B = 1;
L298N driver(EN_A,IN_1,IN_2,IN_3,IN_4,EN_B);
int waktu_tunda = 0; //waktu tunda
int low = 150; //kecepatan default (max kecepatan) 255
int fast = 255; //kecepatan default (max kecepatan) 255

//============buat koneksi ke WI-FI=========
#define SSID "Mi_Dedi" // "SSID‐WiFiname"
#define PASS "edhot111" // "password"
#define IP "192.168.43.22"
//======Alamat File Php
String msg = "GET /monitoringnew/inputdata.php?";
SoftwareSerial esp8266(7,8);// pin ESP8266


void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200); //or use default 115200. 
dht11.begin();
  lcd.init();                      // initialize the lcd 
  lcd.init();
  delay(100);

  lcd.setCursor(0,0);
  lcd.print("Menghubungkan");
  lcd.setCursor(0,1);
  lcd.print("Ke");
  lcd.setCursor(0,2);
  lcd.print("Wi-Fi");
  // Print a message to the LCD.
  lcd.backlight();;
  delay(1000);
  
esp8266.begin(9600);
Serial.println("AT");
esp8266.println("AT");
delay(5000);
if(esp8266.find("OK"))
{
connectWiFi();
}
  
  
}

void loop() {
  // put your main code here, to run repeatedly:
  start:
  error=0;
temp = dht11.readTemperature();
hum = dht11.readHumidity();


//============tampilkan ke LCD
lcd.clear();
lcd.setCursor(0,0);
lcd.print("SUHU     = ");
lcd.print(temp);
lcd.print("C");
lcd.setCursor(0,1);
lcd.print("HUMIDITY = ");
lcd.print(hum);
lcd.print("%");
lcd.setCursor(0,2);
if (temp <=0 && hum <=0 ){lcd.print("Sensor Tidak");}
else if (temp <=19){lcd.print("Suhu Dingin");}
else if (temp <=27){lcd.print("Suhu Normal");}
else if (temp <=32){lcd.print("Suhu Panas");}
else if (temp >=33){lcd.print("Suhu Overheat");}
lcd.setCursor(0,3);
if (temp <=0 && hum <=0){lcd.print("Terdeteksi");}
else if (hum <=39){lcd.print("Udara Kering");}
else if (hum <=79){lcd.print("Udara Normal");}
else if (temp <=90){lcd.print("Udara Lembab");}
else if (temp >=91){lcd.print("Terlalu Lembab");}
delay (1000);

 
if(temp <= 25 ){fannormal();fan = 0;}
else{fanfull();fan = 1;}

notsms = 1;  
if((temp >= 30) && (notsms = 1)){
Sim800l.begin(); // initializate the library.
  text="Suhu Ruangan Overheat";  //text for the message. 
  number="089699971778"; //number for message.
  sms=Sim800l.sendSms(number,text); 
  delay(1000);}
notsms = 0;

notsms1 = 1;  
if(temp <=0){
Sim800l.begin(); // initializate the library.
  text="Sensor Tidak Terdeteksi";  //text for the message. 
  number="089699971778"; //number for message.
  sms=Sim800l.sendSms(number,text); 
  delay(1000);}
notsms1 = 0;
  
updateTemp();
if (error==1)
{
goto start; 
}
delay(1000);

}

void updateTemp()
{
String cmd = "AT+CIPSTART=\"TCP\",\"";
cmd += IP;
cmd += "\",80";
Serial.println(cmd);
esp8266.println(cmd);
delay(2000);
if(esp8266.find("Error"))
{
return;
}
cmd = msg ;
cmd += "&temp="; //field 1 for temperature
cmd += temp;
cmd += "&hum="; //field 2 for humidity
cmd += hum;
cmd += "&fan="; //field 1 for fan
cmd += fan;
cmd += "\r\n";
Serial.print("AT+CIPSEND=");
esp8266.print("AT+CIPSEND=");
Serial.println(cmd.length());
esp8266.println(cmd.length());
if(esp8266.find(">"))
{
Serial.print(cmd);
esp8266.print(cmd);
}else
{
Serial.println("AT+CIPCLOSE");
esp8266.println("AT+CIPCLOSE");
//Resend...
error=1;
}
}

boolean connectWiFi()
{
Serial.println("AT+CWMODE=1");
esp8266.println("AT+CWMODE=1");
delay(2000);
String cmd="AT+CWJAP=\"";
cmd+=SSID;
cmd+="\",\"";
cmd+=PASS;
cmd+="\"";
Serial.println(cmd);
esp8266.println(cmd);
delay(5000);
if(esp8266.find("OK"))
{
return true;
}else
{
return false;
}
}

void fannormal(){
driver.forward(low,waktu_tunda);
}
void fanfull(){
driver.forward(fast,waktu_tunda);
}


