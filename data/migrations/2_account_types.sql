ALTER TABLE accounts MODIFY `type` VARCHAR(31) NOT NULL DEFAULT '';
ALTER TABLE accounttypes MODIFY `name` VARCHAR(31) NOT NULL DEFAULT '';

INSERT INTO accounttypes (`name`)
VALUES ('default'),
  ('Checking'),
  ('Savings'),
  ('Visa'),
  ('Mastercard'),
  ('Discover'),
  ('American Express');