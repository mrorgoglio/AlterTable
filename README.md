AlterTable
==========

AlterTable is a Yii framework behavior.


Introduction
============

AlterTable adds the alter table capabilities to your model (CActiveRecord).

AlterTable behavior uses AdvancedDbCommandBuilder to generate the alter table sql command.

In order to alter the model table you need to provide the extra columns to be added as an array; for each column you must specify the column name, the type, the length and (optionally) if it is a key. 

The array must be in the form:

    {
      //column 1
      {
          'name'=>'column_name_1',
          'label'=>null,
          'key'=>null,
          'type'=>string,
          'length'=>255,
      },
      //column 2
      {
          'name'=>'column_name_2',
          'label'=>null,
          'key'=>null,
          'type'=>integer,
          'length'=>10,
      },
      ...
    }
    


How to use it
============

Requriments
-----------

* Yii 1.1 or above

Installation
------

1.Add AdvancedDbCommandBuilder.php to your components directory (create it if doesn't exist under protected/)

2.Add AlterTableBehavior.php to your behaviors directory (create it if doesn't exist under protected/)

Usage
------

1.Add behavior to your model:

    class MyUser extends CActiveRecord {
       ...
       public function behaviors() {
           return array(
                'AlterTableBehavior'=>array(
                    'class'=>'application.behaviors.AlterTableBehavior',
                 ),
           );
       }
       ...
    }
    
2.Alter it!

    //we suppose you have a model called MyUser, and you want to add city and email columns to the corresponding table
    $attributes = array(
        array(
          'name'=>'City',
          'label'=>null,
          'key'=>null,
          'type'=>string,
          'length'=>255,
        ),
        array(
          'name'=>'Email',
          'label'=>null,
          'key'=>true,
          'type'=>string,
          'length'=>255,
        ),
    );
    MyUser::model()->alterTable($attributes);
