import os
import random
from itertools import chain
import ctypes
import pyttsx3
import speech_recognition as sr
import time
import datetime
import mysql.connector
from mysql.connector import Error

global username

username = "toshith" #username for sql server
password="Y1FoxRXtPg7N+g==" #id tag provided in account settings
host = "192.168.0.104" #ip address of sql server

connection = mysql.connector.connect(host=host,
                                    port='3306',
                                    user=username,
                                    password=password,
                                    database=username)

cur = connection.cursor()


api_key = "a599b31780e5910f9189054fa0eccafb"
base_url = "http://api.openweathermap.org/data/2.5/weather?"


def say(text):
    engine = pyttsx3.init()
    voices = engine.getProperty('voices')
    engine.setProperty('voice', voices[1].id)
    engine.setProperty('rate', 150)
    engine.say(text)
    engine.runAndWait()

cur = connection.cursor()
cur.execute("SELECT words FROM genwords;")
genwords = list(cur)
genwords = list(chain.from_iterable(genwords))
identity = len(genwords)
ident = identity-1

ctypes.windll.kernel32.SetConsoleTitleW("Summer")
os.system("mode con: cols=50 lines=15")

now = datetime.datetime.now()
# global variables
global reply
global emotion
global rtype
global negative
global affirmative
global positiver
global negativer
global functionr
global final_reply
global variab
global link
global db
global command
global command1
global summeremotion

variab = 'yes'

while 1<2:

    r = sr.Recognizer()
    with sr.Microphone() as source:
        audio = r.listen(source)
    try:
        stringe = r.recognize_google(audio)
            
    except sr.UnknownValueError:
        stringe = ""
    except sr.RequestError as e:
        print("ERROR; {0}".format(e))
        stringe = ""
    print(stringe)
    
    stringe = stringe.lower()

    link = ''
    while 1<3:
# process command
        if(variab == 'yes'):
            iden = 0
            check = any(string in stringe for string in genwords)
            if(check == True):
                while iden<identity:
                    tocheck = str(genwords[iden])
                    if(stringe.find(tocheck) < 0):
                        iden += 1
                    elif(iden > ident):
                        print("NOT FOUND")
                        break
                    else:
                        stringe = tocheck
                        print("yes:"+stringe)
                        break
            else:
                stringe = stringe
            command1 = stringe
            stringe = stringe.replace(" ","%")
            if stringe != "":
                stringe = "%"+stringe+"%"
            else:
                stringe=stringe


    # fetch results
            try:
                cur.execute("""SELECT command,emotion,reply,type,negative,affirmative,positiver,negativer,function,db,summeremotion FROM commands WHERE command LIKE \""""+stringe+"""\";""")
                for row in cur.fetchall():
                    command = str(row[0])
                    emotion = str(row[1])
                    reply = str(row[2])
                    rtype = str(row[3])
                    negative = str(row[4])
                    affirmative = str(row[5])
                    positiver = str(row[6])
                    negativer = str(row[7])
                    functionr = str(row[8])
                    db = str(row[9])
                    summeremotion = str(row[10])

    #########   
    #########      #reply processing
                if(rtype == 'basic'):
                    if(reply.find('//') > -1):
                        reply = reply.split("//")
                        final_reply = random.choice(reply)
                        break
                    else:
                        final_reply=reply
                        break
                
                elif(rtype == 'smart'):
                    if(reply.find('//') > -1):
                        reply = reply.split("//")
                        final_reply = random.choice(reply)
                        variab = 'no'
                        break
                    else:
                        final_reply=reply
                        variab = 'no'
                        break

                elif(rtype == 'redirect'):
                    if(reply.find('//') > -1):
                        reply = reply.split("//")
                        final_reply = random.choice(reply)
                        variab = 'no'
                        break
                    else:
                        final_reply=reply
                        variab = 'no'
                        break

                elif(rtype == 'straightredirect'):
                    if(reply.find('//') > -1):
                        reply = reply.split("//")
                        final_reply = random.choice(reply)
                    else:
                        final_reply=reply
                    os.system(functionr)
                    break

                elif(rtype == 'function'):
                    if(reply.find('//') > -1):
                        reply = reply.split("//")
                        final_reply = random.choice(reply)
                    else:
                        final_reply=reply
                    exec(functionr)
                    break

                elif(rtype == 'db'):
                    command = command.split(" ")
                    stringe1 = command1.split(" ")
                    namep = [word for word in stringe1 if word not in command]
                    name = ' '.join(namep)
                    cur.execute("SELECT opinion FROM "+db+" where name=\""+name+"\"")
                    opinion = str(cur.fetchone())
                    cur.execute("SELECT join FROM "+db+" where name=\""+name+"\"")
                    join = str(cur.fetchone())
                    final_reply = str(name+join+opinion)
                    break
                elif(rtype == 'learn'):
                    command = command.split(" ")
                    stringe1 = command1.split(" ")
                    namep = [word for word in stringe1 if word not in command]
                    name = ' '.join(namep)
                    name = name.split(" ")
                    nameof = name[0]
                    name.remove(nameof)
                    name = ' '.join(name)
                    cur.execute("insert into opinion(name, join, opinion) values("+nameof+", "+functionr+", "+name+")")
                    if(reply.find('//') > -1):
                        reply = reply.split("//")
                        final_reply = random.choice(reply)
                    else:
                        final_reply=reply
                    break

                elif(rtype=='weather'):
                    command = command.split(" ")
                    stringe1 = command1.split(" ")
                    namep = [word for word in stringe1 if word not in command]
                    name = ' '.join(namep)
                    name = name.split(" ")
                    nameof = name[0]
                    name.remove(nameof)
                    name = ' '.join(name)
                    print(str(name))
                    final_reply = name
                    break

        ################
        # interactive   reply
                elif(variab == 'no'):
                    if(affirmative.find('//') < 0):
                        affirmative = affirmative.split("//")
                        affirmative = random.choice(affirmative)
                    else:
                        affirmative = affirmative

                    if(negative.find('//') < 0):
                        negative = negative.split("//")
                        negative = random.choice(negative)
                    else:
                        negative = negative

                    if(any(string in stringe for string in affirmative) == True):
                        if(rtype == 'smart'):
                            final_reply = positiver
                            variab = 'yes'
                            break
                        elif(rtype == 'redirect'):
                            final_reply = positiver
                            link = functionr
                            os.system(functionr)
                            break
                    elif(any(string in stringe for string in negative) == True):
                        summeremotion = 'surprised'
                        if(rtype == 'smart'):
                            final_reply = negativer
                            variab = 'yes'
                            break
                        elif(rtype == 'redirect'):
                            final_reply = negativer
                            break
                    else:
                        break

            except   :
                final_reply = "I do not understand"
                break

    if (final_reply.find("user()") > -1):
        final_reply.replace("user()", username)
    print(final_reply)
    say(final_reply)
    stringe = ''
    final_reply = ''
