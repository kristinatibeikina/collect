<?php

require_once ("src/Collect.php");

use PHPUnit\Framework\TestCase;

class CollectTest extends TestCase
{
    public function testCount()
    {
        $collect = new Collect\Collect([13,17]);
        $this->assertSame(2, $collect->count());
    }


    // Тест на ассоциативный массив
    public function testKey()
    {
        $collect = new Collect\Collect(['a' => 'apple', 'b' => 'banana', 'c' => 'cherry']);
        $result = $collect->keys();
        $this->assertEquals(['a', 'b', 'c'], $result->toArray());
    }

    // Тест на пустой массив
    public function testKeyEmpty()
    {
        $collect = new Collect\Collect([]);
        $result = $collect->keys();
        $this->assertEquals([], $result->toArray());
    }

    // Тест на числовые ключи
    public function testKeyNumbers()
    {
        $collect = new Collect\Collect(['1' => 'apple', '2' => 'banana', '3' => 'cherry']);
        $result = $collect->keys();
        $this->assertEquals(['1', '2', '3'], $result->toArray());
    }




    // Тест на ассоциативный массив
    public function testValues()
    {
        $collect = new Collect\Collect(['a' => 'apple', 'b' => 'banana', 'c' => 'cherry']);
        $result = $collect->values();
        $this->assertEquals(['apple', 'banana', 'cherry'], $result->toArray());
    }

    // Тест на пустой массив
    public function testValuesEmpty()
    {
        $collect = new Collect\Collect([]);
        $result = $collect->values();
        $this->assertEquals([], $result->toArray());
    }

    // Тест на числовые значения
    public function testValuesNumbers()
    {
        $collect = new Collect\Collect(['a' => '1', 'b' => '2', 'c' => '3']);
        $result = $collect->values();
        $this->assertEquals(['1', '2', '3'], $result->toArray());
    }


    public function testGet()
    {
        $collect = new Collect\Collect(['a' => 'apple', 'b' => 'banana', 'c' => 'cherry']);
        $result = $collect->get('a');
        $this->assertEquals('apple',$result);
    }

    // Тест на тип возвращаемого значения
    public function testExcept()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collect->except('a', 'c');
        $this->assertEquals(['b' => 2], $result->toArray());
    }

    //Тест на количество элементов
    public function testReturnExceptCount()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collect->except('a', 'c');
        $this->assertCount(1, $result->toArray());
    }
    //
    //Вариант 2
    //

    //Тест на создания коллекции с данными
    public function testOnly()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collect->only('a', 'c');
        $this->assertEquals(['a' => 1, 'c' => 3], $result->toArray());
    }

    //Тест на выбор определенных элементов
    public function testOnlyWithArray()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collect->only(['a', 'c']);
        $this->assertEquals(['a' => 1, 'c' => 3], $result->toArray());
    }

    // Тест на проверку, что первый элемент соответствует ожидаемому
    public function testFirst()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collect->first();
        $this->assertEquals(1, $result);
    }
    // Тест на проверку, что исходная коллекция осталась неизменной
    public function testFirstInvariably()
    {
        $originalData = ['a' => 1, 'b' => 2, 'c' => 3];
        $collect = new Collect\Collect($originalData);
        // Проверяем, что исходная коллекция осталась неизменной
        $this->assertEquals($originalData, $collect->toArray());
    }

    //Тест проверяем корректность возвращаемого кол-во объектов массива
    public function testCountK()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collect->count();
        $this->assertEquals(3, $result);
    }

    //Тест на сравнение оригинального массива и возвращаемого результата
    public function testToArray()
    {
        $data = ['a' => 1, 'b' => 2, 'c' => 3];
        $collect = new Collect\Collect($data);
        $result = $collect->toArray();
        $this->assertEquals($data, $result);
    }


    //
    //Вариант 3
    //

    //Тест на добавление элементов в конец массива
    public function testPush()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2]);

        $collect->push(3, 'c');
        $collect->push(['d' => 4]);
        //Проверка на успешное добавление
        $result = $collect->toArray();

        $expected = ['a' => 1, 'b' => 2, 'c' => 3, ['d' => 4]];
        $this->assertEquals($expected, $result);
    }

    //Тест на добавление элементов в начало массива
    public function testUnshift()
    {
        $collect = new Collect\Collect(['b' => 2, 'c' => 3]);
        //Добавляем элемент
        $collect->unshift(1);
        //Пороверка, что отлично все добавлено
        $result = $collect->toArray();

        $expected = [1, 'b' => 2, 'c' => 3];
        $this->assertEquals($expected, $result);
    }

    //Тест на удаление первого элемента из массива
    public function testShift()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        //Удаляем
        $collect->shift();
        //Проверка на успешность удаления
        $result = $collect->toArray();
        //Сравнение фактического результата с ожидаемым
        $expected = ['b' => 2, 'c' => 3];
        $this->assertEquals($expected, $result);
    }


    //
    //Вариант 4
    //

    //Тест на проверку удаление объекта с конца массива
    public function testPop()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        //Удаляем
        $collect->pop();

        $result = $collect->toArray();

        $expected = ['a' => 1, 'b' => 2];
        $this->assertEquals($expected, $result);
    }

    //Тест на удаление определенного кол-во объектов с определенной позиции
    public function testSplice()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]);

        $collect->splice([1, 2]);

        $result = $collect->toArray();

        $expected = ['a' => 1, 'd' => 4];
        $this->assertEquals($expected, $result);
    }
}


