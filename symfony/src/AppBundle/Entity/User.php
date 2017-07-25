<?php

// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="lenguas_user")
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Role", indexBy="name", inversedBy="users")
     * @ORM\JoinTable(name="lenguas_users_roles")
     */
    protected $user_roles;

    public function __construct()
    {
        parent::__construct();
        $this->user_roles = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add userRole.
     *
     * @param \AppBundle\Entity\Role $userRole
     *
     * @return User
     */
    public function addUserRole(\AppBundle\Entity\Role $userRole)
    {
        $this->user_roles[] = $userRole;

        return $this;
    }

    /**
     * Remove userRole.
     *
     * @param \AppBundle\Entity\Role $userRole
     */
    public function removeUserRole(\AppBundle\Entity\Role $userRole)
    {
        $this->user_roles->removeElement($userRole);
    }

    /**
     * Get userRoles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserRoles()
    {
        return $this->user_roles;
    }

    /**
     * Returns an ARRAY of Role objects with the default Role object appended.
     *
     * @return array
     */
    public function getRoles()
    {
        $user_roles = array();
        if ($this->user_roles) {
            $user_roles = $this->user_roles->toArray();
        }

        return $user_roles;
        //return array_merge($user_roles, array(new Role(array(parent::ROLE_DEFAULT))));
    }

    /**
     * Returns the true ArrayCollection of Roles.
     *
     * @return Doctrine\Common\Collections\ArrayCollection
     */
    public function getRolesCollection()
    {
        return $this->user_roles;
    }

    /**
     * Pass a string, get the desired Role object or null.
     *
     * @param string $role
     *
     * @return Role|null
     */
    public function getRole($role)
    {
        foreach ($this->getRoles() as $roleItem) {
            if ($role == $roleItem->getRole()) {
                return $roleItem;
            }
        }

        return;
    }

    /**
     * Pass a string, checks if we have that Role. Same functionality as getRole() except returns a real boolean.
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if ($this->getRole($role)) {
            return true;
        }

        return false;
    }

    /**
     * Adds a Role OBJECT to the ArrayCollection. Can't type hint due to interface so throws Exception.
     *
     * @throws Exception
     *
     * @param Role $role
     */
    public function addRole($role)
    {
        if (is_string($role)) {
            parent::addRole($role);
        } else {
            if ($role instanceof Role) {
                if (!$this->hasRole($role->getRole())) {
                    $this->user_roles->add($role);
                }
            } else {
                throw new \Exception(sprintf('addRole takes a Role object as the parameter. %s given', get_class($role)));
            }
        }
    }

    /**
     * Pass a string, remove the Role object from collection.
     *
     * @param string $role
     */
    public function removeRole($role)
    {
        $roleElement = $this->getRole($role);
        if ($roleElement) {
            $this->user_roles->removeElement($roleElement);
        }
    }

    /**
     * Pass an ARRAY of Role objects and will clear the collection and re-set it with new Roles.
     * Type hinted array due to interface.
     *
     * @param array $roles of Role objects
     */
    public function setRoles(array $roles)
    {
        $this->user_roles->clear();
        $parentRoles = array();
        foreach ($roles as $role) {
            $this->addRole($role);
            $parentRoles[] = $role->getName();
        }
        parent::setRoles($parentRoles);
    }

    /**
     * Directly set the ArrayCollection of Roles. Type hinted as Collection which is the parent of (Array|Persistent)Collection.
     *
     * @param Doctrine\Common\Collections\Collection $role
     */
    public function setRolesCollection(\Doctrine\Common\Collections\Collection $collection)
    {
        $this->user_roles = $collection;
    }

    public function showRolesDescriptions()
    {
        $rolesDescriptions = [];
        foreach ($this->getRoles() as $role) {
            $rolesDescriptions[] = $role->getDescription();
        }

        return implode(',', $rolesDescriptions);
    }

}
