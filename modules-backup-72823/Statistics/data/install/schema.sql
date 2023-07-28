# Important: the index for column "created" of the table "hit" is used in the Browse Controller.

CREATE TABLE `stat` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `type` VARCHAR(8) NOT NULL,
    `url` VARCHAR(1024) NOT NULL COLLATE `latin1_general_cs`,
    `entity_id` INT NOT NULL,
    `entity_name` VARCHAR(190) NOT NULL,
    `hits` INT NOT NULL,
    `hits_anonymous` INT NOT NULL,
    `hits_identified` INT NOT NULL,
    `created` DATETIME NOT NULL,
    `modified` DATETIME NOT NULL,
    INDEX `IDX_20B8FF218CDE5729` (`type`),
    INDEX `IDX_20B8FF21F47645AE` (`url`),
    INDEX `IDX_20B8FF2181257D5D` (`entity_id`),
    INDEX `IDX_20B8FF2116EFC72D` (`entity_name`),
    INDEX `IDX_20B8FF2181257D5D16EFC72D` (`entity_id`, `entity_name`),
    INDEX `IDX_20B8FF21B23DB7B8` (`created`),
    INDEX `IDX_20B8FF215F6B6CAC` (`modified`),
    UNIQUE INDEX `UNIQ_20B8FF218CDE5729F47645AE` (`type`, `url`(759)),
    PRIMARY KEY(`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

CREATE TABLE `hit` (
    `id` INT AUTO_INCREMENT NOT NULL,
    `url` VARCHAR(1024) NOT NULL COLLATE `latin1_general_cs`,
    `entity_id` INT DEFAULT 0 NOT NULL,
    `entity_name` VARCHAR(190) DEFAULT '' NOT NULL,
    `site_id` INT DEFAULT 0 NOT NULL,
    `user_id` INT DEFAULT 0 NOT NULL,
    `ip` VARCHAR(45) DEFAULT '' NOT NULL,
    `query` LONGTEXT DEFAULT NULL COMMENT '(DC2Type:json)',
    `referrer` VARCHAR(1024) DEFAULT '' NOT NULL COLLATE `latin1_general_cs`,
    `user_agent` VARCHAR(1024) DEFAULT '' NOT NULL COLLATE `latin1_general_ci`,
    `accept_language` VARCHAR(190) DEFAULT '' NOT NULL COLLATE `latin1_general_ci`,
    `created` DATETIME NOT NULL,
    INDEX `IDX_5AD22641F47645AE` (`url`),
    INDEX `IDX_5AD2264181257D5D` (`entity_id`),
    INDEX `IDX_5AD2264116EFC72D` (`entity_name`),
    INDEX `IDX_5AD2264181257D5D16EFC72D` (`entity_id`, `entity_name`),
    INDEX `IDX_5AD22641F6BD1646` (`site_id`),
    INDEX `IDX_5AD22641A76ED395` (`user_id`),
    INDEX `IDX_5AD22641A5E3B32D` (`ip`),
    INDEX `IDX_5AD22641ED646567` (`referrer`),
    INDEX `IDX_5AD22641C44967C5` (`user_agent`),
    INDEX `IDX_5AD22641C2F0CDFC` (`accept_language`),
    INDEX `IDX_5AD22641B23DB7B8` (`created`),
    PRIMARY KEY(`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
