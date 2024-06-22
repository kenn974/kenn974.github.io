DROP TABLE IF EXISTS book_table;
CREATE TABLE book_table(
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  custom VARCHAR(255),
  auther VARCHAR(255),
  situation VARCHAR(255),
  estimation INTEGER NOT NULL,
  impressions VARCHAR(255),
  created_at TIMESTAMP NOT NULL DEFAULT
  CURRENT_TIMESTAMP

)DEFAULT CHARACTER SET = utf8mb4;

INSERT INTO book_table (
  custom,
  auther,
  situation,
  estimation,
  impressions
) VALUES (
  'KINGUDAMU',
  'Hara',
  'MIDOKU',
  '3',
  'so interesting'
);

