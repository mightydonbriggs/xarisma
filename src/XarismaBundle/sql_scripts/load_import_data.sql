-- This script will load test records into the 'import' table

use xarisma;
delete from `import` where true;

INSERT INTO `import`
  (`importTime`, `filename`, `md5`, `status`, `recs`, `errors`, `customerNew`, 
   `customerUpdate`, `orderNew`, `orderUpdate`, `deleted`)
VALUES
  (now(), 'test1.csv', null, 'import success', 100, 0, 50, 50, 50, 50, 0);
INSERT INTO `import`
  (`importTime`, `filename`, `md5`, `status`, `recs`, `errors`, `customerNew`, 
   `customerUpdate`, `orderNew`, `orderUpdate`, `deleted`)
VALUES
  (now(), 'test2.csv', null, 'import success', 20, 0, 5, 15, 5, 15, 0);