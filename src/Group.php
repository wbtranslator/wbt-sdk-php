<?php
declare(strict_types=1);

namespace WBTranslator;

use WBTranslator\Interfaces\GroupInterface;

/**
 * Class Group
 *
 * @package WBTranslator
 */
class Group implements GroupInterface
{
    /**
     * @var int $id
     */
    protected $id;
    
    /**
     * @var string $name
     */
    protected $name;
    
    /**
     * @var string $description
     */
    protected $description;
    
    /**
     * @var GroupInterface $parent
     */
    protected $parent;
    
    /**
     * @var Collection $children
     */
    protected $children;
    
    /**
     * Group constructor.
     */
    public function __construct()
    {
        $this->children = new Collection;
    }
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }
    
    /**
     * @param int $id
     * @return Group
     */
    public function setId(int $id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * @param $name
     * @return Group
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string) $this->description;
    }
    
    /**
     * @param $description
     * @return Group
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        
        return $this;
    }
    
    /**
     * @return GroupInterface
     */
    public function getParent(): GroupInterface
    {
        return $this->parent;
    }
    
    /**
     * @param GroupInterface $parent
     *
     * @return Group
     */
    public function addParent(GroupInterface $parent)
    {
        $this->parent = $parent;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function hasParent(): bool
    {
        return !empty($this->parent) ?: false;
    }
    
    /**
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }
    
    /**
     * @param Collection $children
     *
     * @return Group
     */
    public function addChildren(Collection $children)
    {
        $this->children = $children;
        
        return $this;
    }
    
    /**
     * @param Group|null $group
     *
     * @return array
     */
    public function toArray(Group $group = null)
    {
        if (null === $group) {
            $group = $this;
        }

        $result = [
            'name' => $group->getName(),
        ];
        
        if ($group->getId()) {
            $result['id'] = $group->getId();
        }
    
        if ($group->getDescription()) {
            $result['description'] = $group->getDescription();
        }

        if ($group->hasParent()) {
            $parent = $group->getParent();
            $parent->addChildren(new Collection); // parent show without children
            $result['parent'] = $this->toArray($parent);
        }
        
        if ($group->getChildren()) {
            foreach ($group->getChildren() as $child) {
                $result['children'][] = $this->toArray($child);
            }
        }
        
        return $result;
    }
}
