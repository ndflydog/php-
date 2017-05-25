#!/usr/bin/env python
# Filename: mysqlbackup.py
import    os
import    time
import    sys
import    datetime
from stat import *
 
# mysql user
User = ''
 
# mysql password
Passwd = ''
 
# mysqldump command
Mysqlcommand = '/usr/bin/mysqldump'
 
# gzip command
Gzipcommand = '/bin/gzip'
 
# you want backup mysql database
Mysqldata = os.popen("mysql -uroot -pLonlife0908 -e 'show databases' | egrep -Ev 'information_schema|test|Database|mysql'").readlines()

# you want    backup to dir
Tobackup = '/ldata/bkpackages/dbback/'
 
for DB in Mysqldata:
# backup file name
    DB=DB.strip('\n')
    Backfile = Tobackup + DB + '-' + time.strftime('%Y-%m-%d') + '.sql'
# gzip file name
    Gzfile = Backfile +'.gz'
    if os.path.isfile(Gzfile):
	print Gzfile + " is already backup"
    else:
# backup  command
    	Back_command = Mysqlcommand + ' -u' + User + ' -p' + Passwd + ' -P3306 ' + DB + ' > ' + Backfile
    	if os.system(Back_command)==0:
	    print 'Successful backup to', DB + ' to ' + Backfile
    	else:
	    print 'Backup FAILED'
# gzip command
	Gzip_command = Gzipcommand + ' ' + Backfile
	if os.system(Gzip_command)==0:
	    print 'Successful Gzip to',Gzfile
	else:
	    print 'Gzip FAILED'
# Delete back file
# show file list
filelist=[]
filelist=os.listdir(Tobackup)
# delete Gzfile 5 days ago
for i in range(len(filelist)):
    ft=time.gmtime(os.stat(Tobackup+filelist[i])[ST_MTIME])
    ftl=time.strftime('%Y-%m-%d',ft)
    year,month,day=ftl.split('-')
    ftll=datetime.datetime(int(year),int(month),int(day))
    localt=time.gmtime()
    localtl=time.strftime('%Y-%m-%d',localt)
    year,month,day=localtl.split('-')
    localtll=datetime.datetime(int(year),int(month),int(day))
    days=(localtll-ftll).days
    if days >30:
	try:
		os.remove(Tobackup+filelist[i])
		print 'delete is ok'
	except:
		log=datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')+" remove "+Tobackup+filelist[i]+" fail \n"
    		print log
