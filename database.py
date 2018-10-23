import mysql.connector
from mysql.connector import errorcode

try:
  cnx = mysql.connector.connect(user='root',
                                database='projectfys',
                                host='localhost')
  cursor = cnx.cursor()
except mysql.connector.Error as err:
  if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
    print("Something is wrong with your user name or password")
  elif err.errno == errorcode.ER_BAD_DB_ERROR:
    print("Database does not exist")
  else:
    print(err)
else:
  
    query = ('SELECT * FROM klantgegevens '
             'INNER JOIN passen ON klantgegevens.klantNr = passen.klantNr')
    cursor.execute(query)

    result = cursor.fetchall()

    for row in result:
        print(row[5])
    cnx.close()
