<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/mercadolivre-sdk
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://opensource.gpupo.com/>.
 *
 */

namespace  Gpupo\MercadolivreSdk\Tests\Entity\Order\OrderItems;

use Gpupo\MercadolivreSdk\Entity\Order\Order;
use Gpupo\MercadolivreSdk\Entity\Order\OrderCollection;
use  Gpupo\MercadolivreSdk\Tests\TestCaseAbstract;

/**
 * @coversDefaultClass \Gpupo\MercadolivreSdk\Entity\Order\OrderItems\Collection
 */
class ItemTest extends TestCaseAbstract
{
    public function dataProvider()
    {
        $list = [];
        $collection = new OrderCollection($this->getResourceJson('mockup/Order/list-private.json'));

        foreach ($collection as $order) {
            $list[] = [$order];
        }

        return $list;
    }

    /**
     * @dataProvider dataProvider
     */
    public function testIsACollectionOfItems(Order $order)
    {
        foreach ($order->getOrderItems() as $item) {
            $this->assertStringStartsWith('MLB', $item->getId());
            $this->assertSame('BRL', $item->getCurrencyId());
            $this->assertStringStartsWith('gold', $item->get('listing_type_id'));
        }
    }
}
