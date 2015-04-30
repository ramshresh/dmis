#!/usr/bin/env python
print "Content-type: text/html\n"
#######################################
 # ----A script to extract tweet from twitter
 # streaming API and inserting into database
 # using psycopg2 and twython module-----
 
 # Author: Suman baral
 # Emai: shumanbaral@gmail.com
 # Date: DD/MM/YYYY
 # Version: 1.0
 #######################################

from twython import TwythonStreamer
from twython import Twython
import psycopg2
import sys
import json
from geopy.geocoders import Nominatim
from pytz import timezone
from datetime import datetime
geolocator=Nominatim()
class MyStreamer(TwythonStreamer):
    def on_success(self, data):
         conn = psycopg2.connect("dbname='dmis' user='postgres'")
         cur = conn.cursor()
         data_json=json.dumps(data, ensure_ascii=False)
##         print data_json
         screen_name = data['user']['screen_name']  #screen_name
         user_id = data['user']['id']
         timestamp = data['timestamp_ms']
         status_id = data['id_str']
         
         user_location = data['place']
         print user_location
         if not user_location is None:
             ##---Retrieving location as string and geocoding it---
             user_address = user_location['full_name']+ ','+user_location['name']+','+ user_location['country']
##             user_long_temp = geolocator.geocode(user_address,timeout=60)
##             user_long = user_long_temp.longitude
##             user_lat_temp = geolocator.geocode(user_address,timeout=60)
##             user_lat = user_lat_temp.latitude
##             print user_address
             
         if 'text' in data:
             tweet_text = data['text']

             try:
                 medias = data['entities']['media']
                 multimedia = []
                 for media in medias:
                     multimedia.append(media['media_url_https'])
                 media_list = multimedia
                 print media_list

             except:
                 media_list = None
                 
             pre_hashtag = data['entities']['hashtags']
             hashtag=[]
             for hash in pre_hashtag:    
                 hashtag.append(hash['text'])
             hashtag_list=hashtag

             eastern = timezone('Asia/Kathmandu')
             utc = timezone('UTC')
             created_at = datetime.strptime(data['created_at'], '%a %b %d %H:%M:%S +0000 %Y')
            ##-------utc created date------
             utc_created_at = utc.localize(created_at)
             date = utc_created_at.astimezone(eastern)
             print date

             try:
                 coor=data['coordinates']
                 longitude = (coor["coordinates"][0])
                 latitude = (coor["coordinates"][1])
                 ##-----obtaining the locaiton of geo tagged tweet-----                 
                 temp_location = geolocator.reverse("latitude,longitude",timeout=60)
                 temp_tweet_location = temp_location.address
                 tweet_location=temp_tweet_location
                 print tweet_location
                 coordinates = "POINT(%s %s)" % (longitude,latitude)
                 cur.execute('''INSERT INTO tweet(tweets,geom,tweet_long,tweet_lat,status_json,date,date_utc,tweet_location,hashtags,screen_name,user_id,media_url) VALUES (%s,ST_GeomFromText(%s,4326),%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)''', (tweet_text,coordinates,longitude,latitude,data_json,date,created_at,tweet_location,hashtag_list,screen_name,user_id,media_list))
             except:
                 longitude = None
                 latitude = None
                 coordinates = None
                 tweet_location =None
                 print "No Location"

                 cur.execute('''INSERT INTO tweet(tweets,geom,tweet_long,tweet_lat,status_json,date,date_utc,tweet_location,hashtags,screen_name,user_id,media_url) VALUES (%s,ST_GeomFromText(%s,4326),%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)''', (tweet_text,coordinates,longitude,latitude,data_json,date,created_at,tweet_location,hashtag_list,screen_name,user_id,media_list))
             conn.commit()
                 
            
        # Want to disconnect after the first result?
        # self.disconnect()

    def on_error(self, status_code, data):
        print status_code, data

# Authentication as of Twitter API v1.1
stream = MyStreamer("fq9NcxFeu5qE6yjQJAV6pukf5","oPAovWEA8aHBgqhan7MZMST439RccyEIPvaJVfFnJsJP9KkT4i",
                  "714037699-NEhlB359yt4ghdMLYIvrQLJn7f0jhGDMq5zd63XF",
                  "nfwIUZ1HGp2dt9wUMnBb8py2X90OSs3rEFx641Dwcc1mA")

stream.statuses.filter(track='#earthquake,#disaster,#SwineFlu')

