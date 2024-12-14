<?php
/**
 * Một bộ test suite chuẩn khi nó bao phủ được tất cả các khả năng có thể xảy ra
 */

namespace Tests;

use App\URL;
use PHPUnit\Framework\TestCase;

class URLTest extends TestCase
{
    public function testSluggifyReturnsSluggifiedString()
    {
        $originalString = 'This string will be sluggified';
        $expectedResult = 'this-string-will-be-sluggified';
        $url = new URL();
        $result = $url->sluggify($originalString);
        $this->assertEquals($result, $expectedResult);
    }

    public function testSluggifyReturnsExpectedForStringContainingNumbers()
    {
        $originalString = 'This1 string2 will3 be 44 sluggified10';
        $expectedResult = 'this1-string2-will3-be-44-sluggified10';
        $url = new URL();
        $result = $url->sluggify($originalString);
        $this->assertEquals($result, $expectedResult);
    }

    public function testSluggifyReturnsExpectedForStringContainingSpecialCharacters()
    {
        $originalString = 'This! @string#$ %$will ()be "sluggified';
        $expectedResult = 'this-string-will-be-sluggified';
        $url = new URL();
        $result = $url->sluggify($originalString);
        $this->assertEquals($result, $expectedResult);
    }

    public function testSluggifyReturnsExpectedForStringContainingNonEnglishCharacters()
    {
        $originalString = "Tänk efter nu – förr'n vi föser dig bort";
        $expectedResult = 'tank-efter-nu-forrn-vi-foser-dig-bort';
        $url = new URL();
        $result = $url->sluggify($originalString);
        $this->assertEquals($result, $expectedResult);
    }

    public function testSluggifyReturnsExpectedForEmptyStrings()
    {
        $originalString = '';
        $expectedResult = '';
        $url = new URL();
        $result = $url->sluggify($originalString);
        $this->assertEquals($result, $expectedResult);
    }

    /**
     * @param string $originalString String to be sluggified
     * @param string $expectedResult What we expect our slug result to be
     *
     * @dataProvider providerTestSluggifyReturnsSluggifiedString
     */
    public function testSluggifyReturnsSluggifiedStringUsingDataProvider($originalString, $expectedResult)
    {
        $url = new URL();
        $result = $url->sluggify($originalString);
        $this->assertEquals($result, $expectedResult);
    }

    /**
     * @dataProvider: là 1 test method có thể chấp nhận nhiều input khác nhau.
     * Các tham số này được cung cấp bởi method data provider.
     * 1 method data provider có thể được sử dụng để tạo ra nhiều tập input để truyền vào 1 test method, khắc phục vấn đề phải tạo nhiều method test như ở trên.
     * Thay vì tạo ra nhiều phương thức test, bạn chỉ cần tạo ra 1 phương thức duy nhất với các tham số tương ứng với dữ liệu biến đổi giữa các phép thử.
     * @return array[]
     */
    public function providerTestSluggifyReturnsSluggifiedString()
    {
        return [
            ['This string will be sluggified', 'this-string-will-be-sluggified'],
            ['THIS STRING WILL BE SLUGGIFIED', 'this-string-will-be-sluggified'],
            ['This1 string2 will3 be 44 sluggified10', 'this1-string2-will3-be-44-sluggified10'],
            ['This! @string#$ %$will ()be "sluggified', 'this-string-will-be-sluggified'],
            ["Tänk efter nu – förr'n vi föser dig bort", 'tank-efter-nu-forrn-vi-foser-dig-bort'],
            ['', ''],
        ];
    }
}
