<?php declare(strict_types=1);

namespace EasyAdmin\Entity;

use DateTime;
use Omeka\Entity\AbstractEntity;
use Omeka\Entity\User;

/**
 * Inspired from Drupal Content Lock.
 * @see https://www.drupal.org/project/content_lock
 *
 * It uses an autogenerated id as primary key, even if it is useless with the
 * composite unique index, because it improves performance for doctrine.
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.13/tutorials/composite-primary-keys.html
 *
 * For now, this entity is not available through the api, so no adapter is needed,
 * but it may be added to resources and users representation on request.
 *
 * @Entity
 * @Table(
 *     uniqueConstraints={
 *         @UniqueConstraint(columns={"entity_id", "entity_name"})
 *     }
 * )
 */
class ContentLock extends AbstractEntity
{
    /**
     * @var int
     *
     * @Id
     * @Column(
     *     type="integer"
     * )
     * @GeneratedValue
     */
    protected $id;

    /**
     * API resource id (not necessarily an Omeka main Resource).
     *
     * @var int
     *
     * @Column(
     *     type="integer"
     * )
     */
    protected $entityId;

    /**
     * API resource name (not necessarily an Omeka main Resource).
     *
     * @var string
     *
     * @Column(
     *     type="string",
     *     length=190
     * )
     */
    protected $entityName;

    /**
     * @var \Omeka\Entity\User
     *
     * @ManyToOne(
     *     targetEntity=\Omeka\Entity\User::class
     * )
     * @JoinColumn(
     *     nullable=false,
     *     onDelete="CASCADE"
     * )
     */
    protected $user;

    /**
     * @Column(
     *     type="datetime"
     * )
     */
    protected $created;

    public function __construct(int $entityId, string $entityName)
    {
        $this->entityId = $entityId;
        $this->entityName = $entityName;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEntityId(): int
    {
        return $this->entityId;
    }

    public function getEntityName(): string
    {
        return $this->entityName;
    }

    public function setUser(User $user = null): self
    {
        $this->user = $user;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setCreated(DateTime $created): self
    {
        $this->created = $created;
        return $this;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }
}
