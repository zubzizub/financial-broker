<?php

declare(strict_types=1);

namespace App\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200906182009 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE market_transaction (id UUID NOT NULL, instrument_id UUID NOT NULL, direction VARCHAR(4) NOT NULL, status INT NOT NULL, price DOUBLE PRECISION NOT NULL, count INT NOT NULL, comment TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6658A7CACF11D9C ON market_transaction (instrument_id)');
        $this->addSql('COMMENT ON COLUMN market_transaction.direction IS \'(DC2Type:market_transaction_direction)\'');
        $this->addSql('COMMENT ON COLUMN market_transaction.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE market_transaction ADD CONSTRAINT FK_6658A7CACF11D9C FOREIGN KEY (instrument_id) REFERENCES market_instrument (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE market_transaction');
    }
}
