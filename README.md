# How to Test

Please clone the repository and install via `composer update` command.

Required functionalites are shipped via a package named ``CollectionParser`` and stored in the ``packages/CollectionParser`` directory.

## Exampel CSV File
For this project I assumed the CSV files as yhe following format to be used in the project while parsing.
```
|meeting-rooms           |hall-of-fames|
|------------------------|-------------|
|indirect-emissions–owned|rented       |
|electricity             |gas          |
|natural-gas             |hot-water    |
```
## Artisan Command

There is an artisan command to run the functionalities.
```
php artisan model:publish
```
This command will assume that the required csv file is already uploaded at public directory as `uploads/dataCollection.csv`.

This command also accept an argument as `collectionData`. We can pass the array through this argument. The array needed to be urlencoded. Following is the two examples of that.
```
php artisan model:publish --collectionData=NULL
```
and
```
php artisan model:publish --collectionData=%5B%7B%22scope%22%3A%5B%22indirect-emissions-owned%22%2C%22electricity%22%5D%2C%22name%22%3A%22meeting-rooms%22%7D%2C%7B%22scope%22%3A%5B%22indirect-emissions-rented%22%2C%22electricitytest%22%5D%2C%22name%22%3A%22living-rooms%22%7D%5D
```
This one represents for the array
```
[
   {
      "scope":[
         "indirect-emissions-owned",
         "electricity"
      ],
      "name":"meeting-rooms"
   },
   {
      "scope":[
         "indirect-emissions-rented",
         "electricitytest"
      ],
      "name":"living-rooms"
   }
]

```
##Testing in UI
This project also inculdes a simple form to upload the CSV and the then generates the models by parsing the CSV. This can be found in the following route/url.
```
/parser
```
There you can upload the CSV (Please follow the CSV format) in the form and run the scripts to generate the models as mentioned.

