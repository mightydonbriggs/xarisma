
use xarisma;

-- Load Dictionary data
delete from  `dictionary` where id < 10000;

INSERT INTO `dictionary`
 (`class`, `term`, `definition`, `dateCreated`, `dateUpdated`, `Deleted`)
VALUES
 ('order_status', 'RECEIVED', 'Received from import file', now(), null, 0);

INSERT INTO `dictionary`
 (`class`, `term`, `definition`, `dateCreated`, `dateUpdated`, `Deleted`)
VALUES
 ('order_status', 'HOLD_CUST', 'Hold for customer contact', now(), null, 0);

INSERT INTO `dictionary`
 (`class`, `term`, `definition`, `dateCreated`, `dateUpdated`, `Deleted`)
VALUES
 ('order_status', 'HOLD_MATERIAL', 'Hold for material to arrive', now(), null, 0);

INSERT INTO `dictionary`
 (`class`, `term`, `definition`, `dateCreated`, `dateUpdated`, `Deleted`)
VALUES
 ('order_status', 'HOLD_OTHER', 'Hold for other reason', now(), null, 0);

INSERT INTO `dictionary`
 (`class`, `term`, `definition`, `dateCreated`, `dateUpdated`, `Deleted`)
VALUES
 ('order_status', 'PRODUCTION', 'In production', now(), null, 0);

INSERT INTO `dictionary`
 (`class`, `term`, `definition`, `dateCreated`, `dateUpdated`, `Deleted`)
VALUES
 ('order_status', 'SHIP_READY', 'Ready to Ship', now(), null, 0);

INSERT INTO `dictionary`
 (`class`, `term`, `definition`, `dateCreated`, `dateUpdated`, `Deleted`)
VALUES
 ('order_status', 'SHIP_SHIPPED', 'Order has shipped', now(), null, 0);


-- Load User data
delete from  `user` where id < 10000;

INSERT INTO `user`
  (`username`, `password`, `firstName`, `lastName`, `accessLevel`, `dateCreated`, `dateUpdated`, `Deleted`)
VALUES
  ('admin', 'admin', 'Admin User', '', 100, now(), null, 0);

INSERT INTO `user`
  (`username`, `password`, `firstName`, `lastName`, `accessLevel`,`dateCreated`, `dateUpdated`, `Deleted`)
VALUES
  ('dbriggs', 'dbriggs', 'Don', 'Briggs', 90, now(), null, 0);

INSERT INTO `user`
  (`username`, `password`, `firstName`, `lastName`, `accessLevel`, `dateCreated`, `dateUpdated`, `Deleted`)
VALUES
  ('gbrown', 'gbrown', 'Greg', 'Brown', 90, now(), null, 0);


-- Load Customer data
delete from  `customer` where id < 10000;

INSERT INTO `customer`
  (`customerNumber`, `accountName`, `dateCreated`, `Deleted`)
VALUES
  ('12975', 'Church On Wheels', now(), 0);

INSERT INTO `customer`
  (`customerNumber`, `accountName`, `dateCreated`, `Deleted`)
VALUES
  ('10719', 'Tidmore Flags', now(), 0);

INSERT INTO `customer`
  (`customerNumber`, `accountName`, `dateCreated`, `Deleted`)
VALUES
  ('12758', 'Americanflagstore.com INC', now(), 0);

INSERT INTO `customer`
  (`customerNumber`, `accountName`, `dateCreated`, `Deleted`)
VALUES
  ('13276', 'Flutter Flag Source', now(), 0);

INSERT INTO `customer`
  (`customerNumber`, `accountName`, `dateCreated`, `Deleted`)
VALUES
  ('13884', 'Carrot-Top Industries, Inc.', now(), 0);

INSERT INTO `customer`
  (`customerNumber`, `accountName`, `dateCreated`, `Deleted`)
VALUES
  ('11157', 'Oates Flag Co. Inc.', now(), 0);

INSERT INTO `customer`
  (`customerNumber`, `accountName`, `dateCreated`, `Deleted`)
VALUES
  ('14584', 'US Flag Supply', now(), 0);


-- Load Customer Order Data
delete from  `custorder` where id < 10000;

-- Church On Wheels --
INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('Church%')), '139378', 'RECEIVED', '', '1', now(), 0);

-- Tidmore Flags --
INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('Tidmore%')), '139379', 'RECEIVED', '', '1', now(), 0);

INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('Tidmore%')), '139450', 'RECEIVED', '', '1', now(), 0);

-- Americanflagstore.com --
INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('AmericanFlag%')), '139380', 'RECEIVED', '', '1', now(), 0);

INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('AmericanFlag%')), '139381', 'RECEIVED', '', '1', now(), 0);

-- Flutter Flag Source --
INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('Flutter%')), '139383', 'RECEIVED', '', '1', now(), 0);

-- Carrot Top Industries --
INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('Carrot-Top%')), '13884', 'RECEIVED', '', '1', now(), 0);

INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('Carrot-Top%')), '139456', 'RECEIVED', '', '1', now(), 0);

-- Oats Flag Co. --
INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('Oats%')), '139394', 'RECEIVED', '', '1', now(), 0);

INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('Oats%')), '139395', 'RECEIVED', '', '1', now(), 0);

INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('Oats%')), '139396', 'RECEIVED', '', '1', now(), 0);

INSERT INTO `custorder` 
  (`customer_id`, `orderNumber`, `orderStatus`, `notes`, `updateBy`, `dateCreated`, `deleted`)  
VALUES ((select id from customer where accountName like('Oats%')), '139447', 'RECEIVED', '', '1', now(), 0);

