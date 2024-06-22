CREATE TABLE companies (
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  establishment_date DATE,
  founder VARCHAR(255),
  created_at TIMESTAMP NOT NULL DEFAULT
  CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET = utf8mb4;

//先ず、外枠を作る
INSERT INTO companies (
  name,
  establishment_date,
  founder
) VALUES (
  'SIVER',
  1988-yy-12,
  'Shin Fuzita'
);
