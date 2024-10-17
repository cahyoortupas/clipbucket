CREATE TABLE IF NOT EXISTS `{tbl_prefix}faqs` (
    `faqid` BIGINT AUTO_INCREMENT PRIMARY KEY,
    `question` TEXT NOT NULL,
    `answer` TEXT NOT NULL,
    `date_added` DATETIME NULL,
    `sort` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
