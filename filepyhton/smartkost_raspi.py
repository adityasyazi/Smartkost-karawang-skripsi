import RPi.GPIO as GPIO
import requests
import time
import json
import mfrc522
#from mfrc522 import SimpleMFRC522
#reader = SimpleMFRC522()

MIFAREReader = mfrc522.MFRC522()

Server = "http://192.168.43.246"

URLmode = Server + "/smartkost/admin/readmode.php"
URLadd = Server + "/smartkost/admin/setrfid.php"
URLaccess = Server + "/smartkost/admin/readaccess.php"
URLcmdweb = Server + "/smartkost/admin/readdata.php"

Relay1 = 7 #GPIO4
Relay2 = 11 #GPIO17
Relay3 = 13 #GPIO27
Relay4 = 15 #GPIO22
Relay5 = 29 #GPIO5
Relay6 = 31 #GPIO6
Relay7 = 33 #GPIO13
Relay8 = 37 #GPIO26

delaybukapintu = 5

GPIO.setwarnings(False)
GPIO.cleanup()
GPIO.setmode(GPIO.BOARD)
GPIO.setwarnings(False)
GPIO.setup(Relay1, GPIO.OUT)
GPIO.output(Relay1, True)       #off relay
GPIO.setup(Relay2, GPIO.OUT)
GPIO.output(Relay2, True)       #off relay
GPIO.setup(Relay3, GPIO.OUT)
GPIO.output(Relay3, True)       #off relay
GPIO.setup(Relay4, GPIO.OUT)
GPIO.output(Relay4, True)       #off relay
GPIO.setup(Relay5, GPIO.OUT)
GPIO.output(Relay5, True)       #off relay
GPIO.setup(Relay6, GPIO.OUT)
GPIO.output(Relay6, True)       #off relay
GPIO.setup(Relay7, GPIO.OUT)
GPIO.output(Relay7, True)       #off relay
GPIO.setup(Relay8, GPIO.OUT)
GPIO.output(Relay8, True)       #off relay

#print(URLmode)

MODE = ""

while True:

    responCMD = requests.get(URLcmdweb)
    #print(responCMD.text)
    try:
        responCMDjson = responCMD.json()
        print(json.dumps(responCMDjson, indent=4, sort_keys=True))
        if responCMDjson['kipas1'] == "1":
            print("Kipas 1 Nyala")
            GPIO.output(Relay1, False)       #on relay
        else:
            print("Kipas 1 Mati")
            GPIO.output(Relay1, True)       #off relay

        if responCMDjson['kipas2'] == "1":
            print("Kipas 2 Nyala")
            GPIO.output(Relay2, False)       #on relay
        else:
            print("Kipas 2 Mati")
            GPIO.output(Relay2, True)       #off relay

        if responCMDjson['lampu1'] == "1":
            print("Lampu 1 Nyala")
            GPIO.output(Relay7, False)       #on relay
        else:
            print("Lampu 1 Mati")
            GPIO.output(Relay7, True)       #off relay

        if responCMDjson['lampu2'] == "1":
            print("Lampu 2 Nyala")
            GPIO.output(Relay8, False)       #on relay
        else:
            print("Lampu 2 Mati")
            GPIO.output(Relay8, True)       #off relay

        if responCMDjson['kunci1'] == "1":
            print("Kunci 1 Buka")
            GPIO.output(Relay3, False)       #on relay
            time.sleep(delaybukapintu)
            GPIO.output(Relay3, True)       #off relay

        if responCMDjson['kunci2'] == "1":
            print("Kunci 2 Buka")
            GPIO.output(Relay4, False)       #on relay
            time.sleep(delaybukapintu)
            GPIO.output(Relay4, True)       #off relay

    except:
        print("Decode responCMD JSON error")
    
    responMode = requests.get(URLmode)
    #print(responMode.text)

    try:
        responModeJson = responMode.json()
        MODE = responModeJson['mode']
        #print(responModeJson['mode'])
        #print(responModeJson['keterangan'])
    except:
        print("Decode responMode JSON error")

    if MODE == "1":
        print("Mode Tambah User")
        #read rfid disini
        print("Tap Kartu RFID")
        # Scan for cards    
        (status,TagType) = MIFAREReader.MFRC522_Request(MIFAREReader.PICC_REQIDL)
 
        # If a card is found
        if status == MIFAREReader.MI_OK:
            print ("Card detected")
        
        # Get the UID of the card
        (status,uid) = MIFAREReader.MFRC522_Anticoll()
        
        if status == MIFAREReader.MI_OK:
            # This is the default key for authentication
            key = [0xFF,0xFF,0xFF,0xFF,0xFF,0xFF]
            
            # Select the scanned tag
            MIFAREReader.MFRC522_SelectTag(uid)
            
            rfid = str(hex(uid[0]).split('x')[-1])+"-"+str(hex(uid[1]).split('x')[-1])+"-"+str(hex(uid[2]).split('x')[-1])+"-"+str(hex(uid[3]).split('x')[-1])+'-'+str(hex(uid[4]).split('x')[-1])
            print ("Card read UID: "+rfid)
            URLnew = URLadd + "?rfid=" + rfid
            responAdd = requests.get(URLnew)
            print(responAdd.text)
    elif MODE == "2":
        print("Mode System Access RFID")
        #read rfid disini
        print("Tap Kartu RFID")
        # Scan for cards    
        (status,TagType) = MIFAREReader.MFRC522_Request(MIFAREReader.PICC_REQIDL)
 
        # If a card is found
        if status == MIFAREReader.MI_OK:
            print ("Card detected")
        
        # Get the UID of the card
        (status,uid) = MIFAREReader.MFRC522_Anticoll()
        
        if status == MIFAREReader.MI_OK:
            # This is the default key for authentication
            key = [0xFF,0xFF,0xFF,0xFF,0xFF,0xFF]
            
            # Select the scanned tag
            MIFAREReader.MFRC522_SelectTag(uid)
            
            rfid = str(hex(uid[0]).split('x')[-1])+"-"+str(hex(uid[1]).split('x')[-1])+"-"+str(hex(uid[2]).split('x')[-1])+"-"+str(hex(uid[3]).split('x')[-1])+'-'+str(hex(uid[4]).split('x')[-1])
            print ("Card read UID: "+rfid)
            
            URLnew = URLaccess + "?rfid=" + rfid
            responAccess = requests.get(URLnew)
            print(responAccess.text)
            try:
                responAccessJson = responAccess.json()
                if responAccessJson['status'] == "success":
                    #buka doorlock disini
                    if responAccessJson['ruangan'] == "1":
                        print("Buka Pintu Ruangan 1")
                        GPIO.output(Relay3, False)       #on relay
                        time.sleep(delaybukapintu)
                        GPIO.output(Relay3, True)       #off relay
                        
                    if responAccessJson['ruangan'] == "2":
                        print("Buka Pintu Ruangan 2")
                        GPIO.output(Relay4, False)       #on relay
                        time.sleep(delaybukapintu)
                        GPIO.output(Relay4, True)       #off relay
                        
            except:
                print("Decode responAccess JSON error")
    else:
        print("Mode Raspberry Error")

    time.sleep(1)
    print()
    print()

GPIO.cleanup()
raise