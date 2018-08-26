#!/usr/bin/env python
# -- coding: utf-8 --
from TwitterSearch import *
import time
import json
import mysql.connector
import re
import codecs
import unicodedata
import unicodedata
import codecs
import unicodedata
import json
import emoji
cont = 0
kk = []

#conn =  mysql.connector.connect(user='root', password='',
                        #database='mineracao',host='localhost', charset='utf8')
try:
    tso = TwitterSearchOrder()
    tso.set_keywords(['bolsonaro'])
    tso.set_language('pt')

    ts = TwitterSearch(
        consumer_key = 'IMJh4kjQLGDzUaT9t1v0RXm5Y',
        consumer_secret = 'cjt9d684CpvElXof1BxUMgSakNnFBVLDweQTSpGZolzzrnU8JE',
        access_token = '968521944944529408-oI5NcJVaZellwrsPjhsQkQPDeAZJzKf',
        access_token_secret = 'hc7bTI65fG97smD3ZEB6iCjLrBzHBxn2Sp6TIaX8fZSJZ'
    )
    arquivo = open('arquivo.txt','w')
    def my_callback_closure(current_ts_instance): # accepts ONE argument: an instance of TwitterSearch
        queries, tweets_seen = current_ts_instance.get_statistics()
        if queries > 0 and (queries % 5) == 0: # trigger delay every 5th query
            time.sleep(5) # sleep for 60 seconds

    for tweet in ts.search_tweets_iterable(tso, callback=my_callback_closure):
        cont += 1 
        teste = tweet['source'].split(">")
        teste = teste[1].split("<")
        #cursor = conn.cursor()
        nome = tweet['user']['screen_name']
        aparelho = teste[0]

        localizacao ="ll" #tweet['user']['location'].encode('utf-8')
        #localizacao = localizacao.encode('ascii', 'ignore').decode('ascii')
        #localizacao = localizacao.decode("utf-8")
        localizacao = "ll"#(emoji.demojize ( localizacao ))

        data_tw ="ll" #tweet['created_at'].encode('utf-8')
        #data_tw = (emoji.demojize ( data_tw ))

        texto = tweet['text'].encode('utf-8')
        kk.append(texto)
        
        #teststring = unicode(texto, 'utf-8')
        #teststring = teststring.encode('unicode_escape')        
        print("-----")
        print(tweet['text'])
        print("-----")
        arquivo.write(texto+"\n----------------------------------")
        kk = []
        #arquivo.write(nome+"-"+aparelho+"-"+localizacao+"-"+data_tw+"-"+texto+"\n")
        #cursor.execute ("INSERT INTO twitter (nome, aparelho, localizacao, data_tw, texto) VALUES ('%s','%s','%s','%s','%s')"% (nome, aparelho,localizacao, data_tw, texto))
        #conn.commit()
        print( ( cont ) )


except TwitterSearchException as e:
    print(e)
    
	#print( ( tweet['source'] ) ) - aparelho utilizado
	#print( ( tweet['user']['location'] ) ) - cidade
	#print( ( tweet['created_at'] ) ) - Data
	#print( '@%s tweeted: %s' % ( tweet['user']['screen_name'], tweet['text'] ) )
