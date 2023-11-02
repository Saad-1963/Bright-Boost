# Bright-Boost

Welcome to ShopOnline, a web-based platform or mobile application that simplifies the enrollment process, offers students and tutors a more structured and efficient way to interact, and optimizes program management.
![image](https://github.com/Saad-1963/Bright-Boost/assets/144372364/c191b8a2-b2ab-4401-bdd7-809fc058463d)
.
## overview
#### Registration: 
Users can create their accounts, providing necessary personal information, and establish a secure online presence within the platform.

#### Login: 
Registered users can access their accounts by entering their credentials, ensuring a seamless and personalized experience.

#### Listing: 
Sellers can easily list their items for sale, complete with detailed descriptions and auction parameters, initiating the bidding process.

#### Bidding: 
Buyers can participate in auctions by placing bids on their desired items, engaging in lively competition to secure the items they desire.

#### Maintenance: 
ShopOnline offers essential features for users, such as managing their account details, tracking auctions, and keeping an eye on their bidding activities.

## XML


To Store User data 

```bash
  
<?xml version="1.0"?>
<customers>
  <customer>
    <id>65290c3c10350</id>
    <name>q</name>
    <surname>q</surname>
    <email>qwerty@qwerty.com</email>
    <password>123</password>
  </customer>
</customers>
```


To Store Auctions 

```bash
  
<?xml version="1.0"?>
<items>
  <item>
    <customerID>65290c3c10350</customerID>
    <itemID>65302a2e031ae</itemID>
    <itemName>Fan</itemName>
    <category>Electronics</category>
    <description>abcdefg</description>
    <startingPrice>20</startingPrice>
    <reservePrice>30</reservePrice>
    <buyItNowPrice>30</buyItNowPrice>
    <bidPrice>20</bidPrice>
    <duration>2023-10-20 21:55:42</duration>
    <status>in progress</status>
    <currentDate>2023-10-18</currentDate>
    <currentTime>20:55:42</currentTime>
    <bidderID>65290c3c10350</bidderID>
  </item>
</items>
```


## Demo
#### User Registration
Register a new customer account by providing your name, Surname, email address and password.

![App Screenshot](https://github.com/Saad-1963/project2/blob/daae2dcb1305f20987d0b68f64c689e972f42c65/register.JPG)

#### Login
Log in using your email address and password to access the List of Auctions

![App Screenshot](https://github.com/Saad-1963/project2/blob/daae2dcb1305f20987d0b68f64c689e972f42c65/pass.JPG)

####  Listing
After logging in, you can post anything for auctions by providing details such as item name, Category, Duration, Start Price, and Reserve Price.

![App Screenshot](https://github.com/Saad-1963/project2/blob/daae2dcb1305f20987d0b68f64c689e972f42c65/listing.JPG)


####  Biding
After logging in, you can check auctions also you can buy something from auctions and can place you bid.

![App Screenshot](https://github.com/Saad-1963/project2/blob/daae2dcb1305f20987d0b68f64c689e972f42c65/biding%20page.JPG)


#### Maintenance
Access the Maintenance page change the status of Expired auction Also generate report of Sold and Fialed auctions.

![App Screenshot](https://github.com/Saad-1963/project2/blob/daae2dcb1305f20987d0b68f64c689e972f42c65/report.JPG)

