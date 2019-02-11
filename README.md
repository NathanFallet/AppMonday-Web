# AppMonday-Web

## Repository content

Here is the website of AppMonday, divided in two folders:
- www/ => The website with HTML/CSS/JS
- api/ => The API with PHP/MySQL

[Check out the website online!](https://www.appmonday.xyz/)

## MySQL database

```sql
CREATE TABLE `notification_tokens` (
  `ios_device_token` varchar(255) NOT NULL DEFAULT '',
  `android_reg_id` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`ios_device_token`,`android_reg_id`)
)

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `logo` text NOT NULL,
  `submit` datetime NOT NULL,
  `publish` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);
```

## Mobile apps

AppMonday is also available on Android and iOS, check them out!
- [Android app: NathanFallet/AppMonday-Android](https://github.com/NathanFallet/AppMonday-Android)
- [iOS app: NathanFallet/AppMonday-iOS](https://github.com/NathanFallet/AppMonday-iOS)
