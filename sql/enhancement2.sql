-- Query 1. Inserting Tony Stark into clients tabll
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment)
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');

-- Query 2. Updating Stark's clientLevel to 3
UPDATE clients
SET clientLevel = 3
WHERE clientFirstname = 'Tony'
AND clientLastname = 'Stark';

-- Query 3. Update the inventory table and replace small interiors in the GM Hummer row with spacious interiors.
Update inventory
Set invDescription = replace(invDescription, 'small interiors', 'spacious interior')
WHERE invMake = 'GM'
AND invModel = 'HUMMER';

-- Query 4. Use an inner join to select the invModel field from the inventory table and the classificationName 
-- field from the carclassification table for inventory items that belong to the "SUV" category.
SELECT invModel, classificationName
FROM inventory as t1
INNER JOIN carclassification as t2
ON t1.classificationId = t2.classificationId
WHERE classificationName = 'SUV';

-- Query 5. Delete the Jeep Wranger from the database
DELETE FROM inventory WHERE invMake = 'Jeep' AND invModel = 'Wrangler';

-- Query 6. Update all records in the Inventory table to add "/phpmotors" to the beginning of the file path in the invImage and invThumbnail columns using a single query.
UPDATE inventory
SET invImage = CONCAT('/phpmotors', invImage), invThumbnail = CONCAT('/phpmotors', invThumbnail);