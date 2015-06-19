-- This script will purge all data from the customer, custorder, and fileops
-- tables. It is used to delete existing data for import/export testing
--
-- Don Briggs <donbriggs@donbriggs.com>    2015-06-15

use xarisma;

delete from xarisma.fileops where true;
delete from xarisma.custorder where true;
delete from xarisma.customer where true;
