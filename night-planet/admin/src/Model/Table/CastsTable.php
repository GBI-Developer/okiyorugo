<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Casts Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Shops
 * @property |\Cake\ORM\Association\HasMany $CastSchedules
 * @property |\Cake\ORM\Association\HasMany $DiaryLikes
 * @property |\Cake\ORM\Association\HasMany $Diarys
 * @property |\Cake\ORM\Association\HasMany $Snss
 * @property |\Cake\ORM\Association\HasMany $Updates
 *
 * @method \App\Model\Entity\Cast get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cast newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cast[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cast|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cast saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cast patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cast[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cast findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CastsTable extends Table
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

        $this->setTable('casts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('shops', [
            'foreignKey' => 'shop_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('diarys', [
            'foreignKey' => 'cast_id'
        ]);
        $this->hasMany('cast_schedules', [
            'foreignKey' => 'cast_id'
        ]);
        $this->hasMany('snss', [
            'foreignKey' => 'cast_id'
        ]);
        $this->hasMany('updates', [
            'foreignKey' => 'cast_id'
        ]);
        $this->hasMany('cast_likes', [
            'foreignKey' => 'cast_id'
        ]);
    }

    /**
     * バリデーション ログイン.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationCastLogin(Validator $validator)
{
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email','メールアドレスを入力してください。')
            ->allowEmptyString('email', false);

        $validator
            ->scalar('password')
            ->maxLength('password', 32,'パスワードが長すぎます。')
            ->minLength('password', 8,'パスワードが短すぎます。')
            ->notEmpty('password','パスワードを入力してください。')
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false);

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        return $validator;
    }

    /**
     * バリデーション プロフィール変更用.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationProfile(Validator $validator)
{
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->notEmpty('name','名前を入力してください。')
            ->maxLength('name', 30, '名前が長すぎます。')
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('nickname')
            ->notEmpty('nickname','ニックネームを入力してください。')
            ->maxLength('nickname', 30, 'ニックネームが長すぎます。')
            ->requirePresence('nickname', 'create')
            ->allowEmptyString('nickname', false);

        $validator
            ->date('birthday')
            ->allowEmptyTime('birthday');

        $validator
            ->scalar('age')
            ->maxLength('age', 5)
            ->allowEmptyString('age');

        $validator
            ->scalar('blood_type')
            ->maxLength('blood_type', 20)
            ->allowEmptyString('blood_type');

        $validator
            ->scalar('constellation')
            ->maxLength('constellation', 20)
            ->allowEmptyString('constellation');

        $validator
            ->scalar('message')
            ->maxLength('message', 50,'メッセージが長すぎます。')
            ->allowEmptyString('message', true);

        return $validator;
    }

    /**
     * バリデーション パスワードリセット.その１
     * パスワードリセットで使用
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationCastPassReset1(Validator $validator)
    {
        $validator
            ->email('email',false, "メールアドレスの形式が不正です。")
            ->notEmpty('email','メールアドレスを入力してください。')
            ->add('email', [
                'exists' => [
                    'rule' => function($value, $context) {
                        return TableRegistry::get('casts')->exists(['email' => $value]);
                    },
                    'message' => 'そのメールアドレスは登録されてません。'
                ],
            ]);

        return $validator;
    }

    /**
     * バリデーション パスワードリセット.その２
     * パスワードリセットで使用
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationCastPassReset2(Validator $validator)
    {
        $validator
            ->scalar('password')
            ->maxLength('password', 32,'パスワードが長すぎます。')
            ->minLength('password', 8,'パスワードが短すぎます。')
            ->notEmpty('password','パスワードを入力してください。')
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false);

        return $validator;
    }

    /**
     * バリデーション パスワードリセット.その３
     * パスワード変更で使用
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationCastPassReset3(Validator $validator)
    {
        $validator
            ->scalar('password')
            ->maxLength('password', 32,'パスワードが長すぎます。')
            ->minLength('password', 8,'パスワードが短すぎます。')
            ->notEmpty('password','パスワードを入力してください。')
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false);

        $validator
            ->scalar('password_new')
            ->maxLength('password_new', 32,'パスワードが長すぎます。')
            ->minLength('password_new', 8,'パスワードが短すぎます。')
            ->notEmpty('password_new','パスワードを入力してください。')
            ->requirePresence('password_new', 'create')
            ->allowEmptyString('password_new', false);

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['shop_id'], 'shops'));

        return $rules;
    }
}
