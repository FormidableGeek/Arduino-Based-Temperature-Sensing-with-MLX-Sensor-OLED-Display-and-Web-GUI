import usb.core
import usb.util
import time
import struct
import json
import http.server
import libusb1
import socketserver


# Vendor ID and Product ID for the Arduino Nano (change if needed)
VENDOR_ID = 0x1A86
PRODUCT_ID = 0x7523

# Endpoint values (change if needed)
ENDPOINT_IN = 0x82
ENDPOINT_OUT = 0x02
# Timeout for USB communication (adjust as needed)
TIMEOUT = 500

def initialize_usb():
    # Find the Arduino Nano device
    dev = usb.core.find(idVendor=VENDOR_ID, idProduct=PRODUCT_ID)

    if dev is None:
        raise ValueError("Arduino Nano not found.")

    # Set the active configuration of the USB device
    dev.set_configuration()
    return dev

def read_data(dev):
    try:
        # Read data from the Arduino Nano over USB
        data = dev.read(ENDPOINT_IN, 32, TIMEOUT)
        #new configuration to decode data Sent As String From Arduino Code
        #data_str= data.decode('utf-8')          #try to Convert if Sent As Float Data... old Configuration 
        data_str=float(bytearray(data).decode('utf-8').strip())
        # Convert the byte data to a string
       
                # Check if data is bytes-like
        return data_str
    except usb.core.USBError as e:
      return e
device = initialize_usb()


class MyHttpRequestHandler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/python':
            data = read_data(device)
            data_str=data

            if data is not None:
                self.send_response(200)
                self.send_header('Access-Control-Allow-Origin', '*')
                self.send_header('Access-Control-Allow-Methods', 'GET')

                self.send_header('Content-type', 'application/json')
                self.end_headers()
                response='{"temperature":'+str(data_str)+'}'
                self.wfile.write(response.encode())
            else:
                self.send_response(500)
                self.end_headers()

if __name__ == "__main__":
    # Initialize USB communication with the Arduino Nano
    #device = initialize_usb()

    # Set up the HTTP server
    PORT = 8001
    my_server = socketserver.TCPServer(("localhost", PORT), MyHttpRequestHandler)
    print(f"Server started at http://localhost:{PORT}")

    try:
        # Start the HTTP server
        my_server.serve_forever()
    except KeyboardInterrupt:
        # Close the USB connection on program exit
        usb.util.dispose_resources(device)
        my_server.server_close()
        print("Server stopped.") USB connection on program exit
        usb.util.dispose_resources(device)
        my_server.server_close()
        print("Server stopped.")