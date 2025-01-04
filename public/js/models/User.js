export class User {
  constructor(
    userId,
    name,
    lastName,
    address,
    mail,
    phone,
    role,
    pass,
    city,
    cp
  ) {
    this.userId = userId;
    this.name = name;
    this.lastName = lastName;
    this.address = address;
    this.mail = mail;
    this.phone = phone;
    this.role = role;
    this.pass = pass;
    this.city = city;
    this.cp = cp;
  }
}
