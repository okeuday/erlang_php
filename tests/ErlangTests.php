<?php //-*-coding:utf-8;tab-width:4;c-basic-offset:4;indent-tabs-mode:()-*-
// ex: set ft=php fenc=utf-8 sts=4 ts=4 sw=4 et:
//
// BSD LICENSE
// 
// Copyright (c) 2014, Michael Truog <mjtruog at gmail dot com>
// All rights reserved.
// 
// Redistribution and use in source and binary forms, with or without
// modification, are permitted provided that the following conditions are met:
// 
//     * Redistributions of source code must retain the above copyright
//       notice, this list of conditions and the following disclaimer.
//     * Redistributions in binary form must reproduce the above copyright
//       notice, this list of conditions and the following disclaimer in
//       the documentation and/or other materials provided with the
//       distribution.
//     * All advertising materials mentioning features or use of this
//       software must display the following acknowledgment:
//         This product includes software developed by Michael Truog
//     * The name of the author may not be used to endorse or promote
//       products derived from this software without specific prior
//       written permission
// 
// THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND
// CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
// INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
// OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
// DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
// CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
// BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
// SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
// INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
// WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
// OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
// DAMAGE.
//
require dirname(__FILE__) . '/../Erlang.php';

class AtomTestCase extends PHPUnit_Framework_TestCase
{
    public function test_atom()
    {
        $atom1 = new \Erlang\OtpErlangAtom('test');
        $this->assertEquals(get_class($atom1), 'Erlang\OtpErlangAtom');
        $this->assertEquals(new \Erlang\OtpErlangAtom('test'), $atom1);
        $this->assertEquals('Erlang\OtpErlangAtom(test,utf8=false)',
                            (string) $atom1);
        $atom2 = new \Erlang\OtpErlangAtom('test2');
        $atom1_new = new \Erlang\OtpErlangAtom('test');
        $this->assertNotEquals($atom1, $atom2);
        $this->assertEquals($atom1, $atom1_new);
        $atom3 = new \Erlang\OtpErlangAtom(str_repeat('X', 256));
        $this->assertEquals(str_repeat('X', 256), $atom3->value);
    }
    /**
     * @expectedException \Erlang\OutputException
     * @expectedExceptionMessage unknown atom type
     */
    public function test_invalid_atom()
    {
        $atom_invalid = new \Erlang\OtpErlangAtom(array(1, 2));
        $atom_invalid->binary();
    }
}

?>
