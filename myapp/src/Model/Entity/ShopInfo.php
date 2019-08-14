<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ShopInfo Entity
 *
 * @property int $id
 * @property int $shop_id
 * @property string $content
 * @property string|null $image
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Shop $shop
 */
class ShopInfo extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'shop_id' => true,
        'title' => true,
        'content' => true,
        'image1' => true,
        'dir' => true,
        'created' => true,
        'modified' => true,
        'shop' => true
    ];
}
