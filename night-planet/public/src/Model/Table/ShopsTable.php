<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shops Model
 *
 * @property \App\Model\Table\OwnersTable|\Cake\ORM\Association\BelongsTo $Owners
 * @property \App\Model\Table\CastSchedulesTable|\Cake\ORM\Association\HasMany $CastSchedules
 * @property \App\Model\Table\CastsTable|\Cake\ORM\Association\HasMany $Casts
 * @property \App\Model\Table\CouponsTable|\Cake\ORM\Association\HasMany $Coupons
 * @property \App\Model\Table\JobsTable|\Cake\ORM\Association\HasMany $Jobs
 * @property \App\Model\Table\ShopInfoLikesTable|\Cake\ORM\Association\HasMany $ShopInfoLikes
 * @property \App\Model\Table\ShopInfosTable|\Cake\ORM\Association\HasMany $ShopInfos
 * @property \App\Model\Table\SnssTable|\Cake\ORM\Association\HasMany $Snss
 * @property \App\Model\Table\UpdatesTable|\Cake\ORM\Association\HasMany $Updates
 * @property \App\Model\Table\WorkSchedulesTable|\Cake\ORM\Association\HasMany $WorkSchedules
 *
 * @method \App\Model\Entity\Shop get($primaryKey, $options = [])
 * @method \App\Model\Entity\Shop newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Shop[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Shop|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shop saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shop patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Shop[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Shop findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShopsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('shops');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('owners', [
            'foreignKey' => 'owner_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('casts', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('coupons', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('jobs', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('shop_info_likes', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('shop_infos', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('snss', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('updates', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('work_schedules', [
            'foreignKey' => 'shop_id'
        ]);
        $this->hasMany('adsenses', [
            'foreignKey' => 'shop_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {

        $validator->setProvider('custom', 'App\Model\Validation\CustomValidation');

        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('area')
            ->notEmpty('area','エリアを選択してください。')
            ->requirePresence('area', 'create');

        $validator
            ->scalar('genre')
            ->notEmpty('genre','店舗のジャンルを選択してください。')
            ->requirePresence('genre', 'create');

        $validator
            ->scalar('dir')
            ->maxLength('dir', 255)
            ->allowEmptyString('dir');

        $validator
            ->scalar('name')
            ->maxLength('name', 40,"店舗名は40文字以内にしてください。")
            ->allowEmptyString('name');

        $validator
            ->scalar('catch')
            ->minLength('catch', 5,"キャッチコピーが短すぎます。")
            ->maxLength('catch', 100,"キャッチコピーは100文字以内にしてください。")
            ->allowEmptyString('catch');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 15,"電話番号が長いです。")
            ->allowEmptyString('tel')
            ////電話番号形式のチェック ////
            ->add('tel', 'tel_check',[
                'rule' =>'tel_check',
                'provider' => 'custom',
                'message' => '無効な電話番号です。'
            ]);

        $validator
            ->scalar('staff')
            ->maxLength('staff', 255,"スタッフは255文字以内にしてください。")
            ->allowEmptyString('staff');

        $validator
            ->time('bus_from_time')
            ->allowEmptyTime('bus_from_time');
        // TODO: bus_to_time => 営業時間の終了は「LAST」も含めた方がよいのでは？
        $validator
            ->time('bus_to_time')
            ->allowEmptyTime('bus_to_time');

        $validator
            ->scalar('bus_hosoku')
            ->maxLength('bus_hosoku', 255,"補足は120文字以内にしてください。")
            ->allowEmptyString('bus_hosoku');

        $validator
            ->scalar('system')
            ->maxLength('system', 900,"システムは900文字以内にしてください。")
            ->allowEmptyString('system');

        $validator
            ->scalar('credit')
            ->maxLength('credit', 255)
            ->allowEmptyString('credit');

        $validator
            ->scalar('pref21')
            ->maxLength('pref21', 3,"都道府県が不正です。")
            ->allowEmptyString('pref21');

        $validator
            ->scalar('addr21')
            ->maxLength('addr21', 10,"市町村が不正です。")
            ->allowEmptyString('addr21');

        $validator
            ->scalar('strt21')
            ->maxLength('strt21', 30,"以降の住所が不正です。")
            ->allowEmptyString('strt21');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['owner_id'], 'Owners'));

        return $rules;
    }

        /**
     * リクエストデータがエンティティーに変換される前に呼ばれる処理。 
     * 主にリクエストデータに変換を掛けたり、バリデーションを条件次第で事前に解除したりできる。
     * @param Event $event
     * @param ArrayObject $data
     * @param ArrayObject $options
     * @return void
     */
    // public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    // {
    //     // telは、ハイフン削除
    //     if (isset($data['tel'])) {
    //         $data['tel'] = str_replace(array('-', 'ー', '"', '―', '‐'), '', $data['tel']);
    //     }

    // }
}
