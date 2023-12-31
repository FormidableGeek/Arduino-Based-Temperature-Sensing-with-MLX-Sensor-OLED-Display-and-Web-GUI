#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <Adafruit_MLX90614.h>
#include <Fonts/FreeMonoBold18pt7b.h>


#define SCREEN_WIDTH 128 // OLED display width, in pixels
#define SCREEN_HEIGHT 64 // OLED display height, in pixels

// Declaration for an SSD1306 display connected to I2C (SDA, SCL pins)
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);
Adafruit_MLX90614 mlx = Adafruit_MLX90614();
double temp_obj;


void setup() {
  Serial.begin(115200);
  mlx.begin();
  if(!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) { // Address 0x3C for 128x64
    for(;;);
  }
  delay(2000);
  display.clearDisplay();

  display.setTextSize(1);
  display.setTextColor(WHITE);
  display.setCursor(0, 10);
  // Display static text
  display.println("Hello, world!");
  display.display(); 
}

void loop() {
  temp_obj = mlx.readObjectTempC();
  String temp=String(temp_Obj,2);
  //send data via USB
  Serial.print(temp);
  display.setFont(&FreeMonoBold18pt7b);
  display.setTextColor(WHITE);        // Draw white text
  display.setCursor(0, 50);
   display.println(temp_obj);
  display.drawCircle(92, 35, 3, WHITE);
  display.setCursor(100, 50);
  display.print("C");
  display.display();

  
  display.clearDisplay();


  
  delay(1000);


}