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
#import emoji
cont = 0
kk = []

candidato = 'anastasia'                        
dia = time.strftime('%d %b %y')                        
horas = time.strftime('%H:%M:%S')                        
try:
    tso = TwitterSearchOrder()
    tso.set_keywords([candidato])
    tso.set_language('pt')

    ts = TwitterSearch(
        consumer_key = 'IMJh4kjQLGDzUaT9t1v0RXm5Y',
        consumer_secret = 'cjt9d684CpvElXof1BxUMgSakNnFBVLDweQTSpGZolzzrnU8JE',
        access_token = '968521944944529408-oI5NcJVaZellwrsPjhsQkQPDeAZJzKf',
        access_token_secret = 'hc7bTI65fG97smD3ZEB6iCjLrBzHBxn2Sp6TIaX8fZSJZ'
    )
    arquivo = open('arquivos/'+candidato+' '+ dia +' '+ horas +'.txt','w')
    def my_callback_closure(current_ts_instance): # accepts ONE argument: an instance of TwitterSearch
        queries, tweets_seen = current_ts_instance.get_statistics()
        if queries > 0 and (queries % 5) == 0: # trigger delay every 5th query
            time.sleep(60) # sleep for 60 seconds
                
    for tweet in ts.search_tweets_iterable(tso, callback=my_callback_closure):              

        twid = tweet['id']
        nome = tweet['user']['screen_name'].encode('utf-8')
        localicacao = tweet['user']['location'].encode('utf-8')
        aparelho = tweet['source'].encode('utf-8')
        data = tweet['created_at'].encode('utf-8')
        texto = tweet['text'].encode('utf-8')        

        arquivo.write(str(cont))
        arquivo.write('|||' + str(twid))
        arquivo.write('|||' + str(nome))
        arquivo.write('|||' + str(localicacao))
        arquivo.write('|||' + str(aparelho))
        arquivo.write('|||' + str(data))
        arquivo.write('|||' + str(texto))        
        arquivo.write('\n-------------------------\n')
        print(cont)
        print(data)
        cont +=1


except TwitterSearchException as e:
    print(e)
    
	#print( ( tweet['source'] ) ) - aparelho utilizado
	#print( ( tweet['user']['location'] ) ) - cidade
	#print( ( tweet['created_at'] ) ) - Data
	#print( '@%s tweeted: %s' % ( tweet['user']['screen_name'], tweet['text'] ) )
    #print(tweet['user']['description'])
