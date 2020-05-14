<?php
/**
* 
* This script can be used to generate "self-executing" .php Files.
* example (require this file or autoload webfan\MimeStubAPC:
* 
* Dowload an example implementation at https://webfan.de/install/php/  
* 
*   $vm = \webfan\MimeStubAPC::vm();
* 
* // echo print_r($vm, true);
* 
* $newFile = __DIR__. DIRECTORY_SEPARATOR . 'TestMimeStubAPC.php';
* 
* 
* $a = <<<PHPE
* 
* echo ' TEST-modified.';
* 
* PHPE;
* 
* 
* $stub = $vm->get_file($vm->document, '$HOME/index.php', 'stub index.php')
* // ->clear()
*   ->append($a)
* ;
* 
*  $vm->to('hello@wor.ld');
*  $vm->from('me@localhost');
*  $stub->from('hello@wor.ld');  
*     
* $vm->location = $newFile;
* require $newFile;
* $run($newFile);
*  
** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** 
**
 * Copyright  (c) 2017, Till Wehowski
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. Neither the name of frdl/webfan nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY frdl/webfan ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL frdl/webfan BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
* 
* 
* 
* 
** includes edited version of:
*  https://github.com/Riverline/multipart-parser 
* 
* Class Part
* @package Riverline\MultiPartParser
* 
*  Copyright (c) 2015-2016 Romain Cambien
*  
*  Permission is hereby granted, free of charge, to any person obtaining a copy
*  of this software and associated documentation files (the "Software"),
*  to deal in the Software without restriction, including without limitation
*  the rights to use, copy, modify, merge, publish, distribute, sublicense,
*  and/or sell copies of the Software, and to permit persons to whom the Software
*  is furnished to do so, subject to the following conditions:
*  
*  The above copyright notice and this permission notice shall be included
*  in all copies or substantial portions of the Software.
*  
*  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
*  INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
*  IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
*  DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
*  ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
*  OTHER DEALINGS IN THE SOFTWARE.
* 
*  - edited by webfan.de
*/

namespace frdlweb{
	



if (!\interface_exists(StubHelperInterface::class, false)) {	
 interface StubHelperInterface
 { 
  public function runStubs();
  public function addPhpStub($code, $file = null);	 
  public function addWebfile($path, $contents, $contentType = 'application/x-httpd-php', $n = 'php');	 
  public function addClassfile($class, $contents);
  public function get_file($part, $file, $name); 
  public function Autoload($class);   
  public function __toString();	
  public function __invoke(); 	
  public function __call($name, $arguments);
  public function getFileAttachment($file = null, $offset = null);	   
 }
} 
 

	
if (!\interface_exists(StubItemInterface::class, false)) { 	
interface StubItemInterface
{
	    public function getMimeType();
	    public function getName() ;
        public function getFileName();
        public function isFile();
        public function getParts();
        public function getPartsByName( $name);
        public function addFile( $type = 'application/x-httpd-php',  $disposition = 'php',  $code,  $file,  $name);
        public function isMultiPart();
        public function getBody($reEncode = false, &$encoding = null);
        public function __toString();
 }
}
	
	
if (!\interface_exists(StubRunnerInterface::class, false)) { 
interface StubRunnerInterface
 { 
 	public function loginRootUser($username = null, $password = null) : bool;		
	public function isRootUser() : bool;
	public function getStubVM() : StubHelperInterface;	
	public function getStub() : StubItemInterface;		
	public function __invoke() :?StubHelperInterface;	
	public function getInvoker();	
	public function getShield();	
	public function autoloading() : void;
}	
}		
	
}//namespace frdlweb

namespace App\compiled\Instance\MimeStub2\MimeStubEntity408263755{
use frdl;
use frdlweb\StubItemInterface as StubItemInterface;	 
use frdlweb\StubHelperInterface as StubHelperInterface;
use frdlweb\StubRunnerInterface as StubRunnerInterface;	
	



if(!defined('___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___')){

}






 class MimeVM implements StubHelperInterface
 {
 	
 	
 	public $e_level = E_USER_ERROR;
 	
 //	protected $Request = false;
  //	protected $Response = false;	
 	
 	protected $raw = false;
 	protected $MIME = false;
 	
 	protected $__FILE__ = false;
 	protected $buf;
 	
 	//stream
 	protected $IO = false;
 	protected $file = false;
 	protected $host = false;
 	protected $mode = false;
 	protected $offset = false;
 	
 	
 //	protected $Context = false; 	
 //	protected $Env = false;
 	
 	protected $initial_offset = 0;
 	
 	protected $php = array();
 	
 
 	protected $_lint = true;
 
    protected $mimes_engine = array(
         'application/vnd.frdl.script.php' => '_run_php_1',
         'application/php' => '_run_php_1',
         'text/php' => '_run_php_1',
         'php' => '_run_php_1',
         'multipart/mixed' => '_run_multipart',
         'multipart/serial' => '_run_multipart',
         'multipart/related' => '_run_multipart',
         'application/x-httpd-php' => '_run_php_1',
    );

	protected function _run_multipart($_Part){

		 	foreach( $_Part->getParts() as $pos => $part){
		 		if(isset($this->mimes_engine[$part->getMimeType()])){
					call_user_func_array(array($this, $this->mimes_engine[$part->getMimeType()]), array($part));
				}
    	    }

	}
	 
	 
   public function getPhpFileTypes(){
	   $a = [];
	   foreach($this->mimes_engine as $type => $handler){
		   if('_run_php_1'===$handler){
			   $a[]=$type;
		   }
	   }
	   return $a;
   }	 
	 
	 
   public function getBootStubs(){
	   return $this->get_file($this->document, '$__FILE__/stub.zip', 'archive stub.zip');	
   }
	 
	 
  	public function runStubs($stubs = null){
      $BootStubs = (!is_null($stubs)) ? $stubs : $this->getBootStubs();	
		
		
	  foreach( $BootStubs->getParts() as $rootPos => $rootPart){
		
		  	  
          if($rootPart->isMultiPart())	{
		 	foreach( $rootPart->getParts() as $pos => $part){		
				
		 		if(isset($this->mimes_engine[$part->getMimeType()])){
					call_user_func_array(array($this, $this->mimes_engine[$part->getMimeType()]), array($part));
				}				
    	    }
		  }else{
			 	if(isset($this->mimes_engine[$rootPart->getMimeType()])){
					call_user_func_array(array($this, $this->mimes_engine[$rootPart->getMimeType()]), array($rootPart));
				}			  
		  }
		//  break;
       }// each
		
		
	 }


  public function addPhpStub($code, $file = null){
	  
		
	$archive = $this->get_file($this->document, '$__FILE__/stub.zip', 'archive stub.zip');

	  
	if(null === $file){
		$file = '$STUB/index-'.count($archive->getParts()).'.php';
	}
				   
    $archive->addFile('application/x-httpd-php', 'php', $code, $file/* = '$__FILE__/filename.ext' */, 'stub stub.php');
	return $this;
  }
	 
  public function addWebfile($path, $contents, $contentType = 'application/x-httpd-php', $n = 'php'){
	 $this->get_file($this->document, '$__FILE__/attach.zip', 'archive attach.zip')
		->addFile($contentType, $n, $contents, '$HOME/$WEB'.$path, 'stub '.$path);
	return $this;
  }
	 
  public function addClassfile($class, $contents){
	 $this->get_file($this->document, '$__FILE__/attach.zip', 'archive attach.zip')
		->addFile('application/x-httpd-php', 'php', utf8_encode($contents), '$DIR_PSR4/'.str_replace('\\', '/', $class).'.php', 'class '.$class);
	return $this;
  }
	 	 
	 
     public function get_file($part, $file, $name){
    	
		 if(null === $part || !is_object($part) ){
			return false; 
		 }
		 
			
      if($file === $part->getFileName() || $name === $part->getName()){
	  	   	  return $part;
	  }	
    	
	 	
	 $r = function($part, $file, $name, $r) {	   
		 if(null === $part || !is_object($part) ){
			return false; 
		 }		 
		 
	   if($file === $part->getFileName() || $name === $part->getName()){
	  	   	  return $part;
	   }		 
       if($part->isMultiPart())	{
        foreach( $part->getParts() as $pos => $_part){
					 if(null === $_part || !is_object($_part) ){			
						 continue; 		
					 }			
			if(!$_part->isMultiPart() && $file === $_part->getFileName() || $name === $_part->getName()){
		   	  return $_part;
	        }elseif($_part->isMultiPart()){
				 $_f = $r($_part, $file, $name, $r);
				if(false !== $_f){
				   return $_f;	
				}
			}
        }	
      } 
		 
		 return false;
	 };
		
		return $r($part, $file, $name, $r);
    }
	 
	 

	public function Autoload($class){
          $fnames = array( 
                  '$LIB/'.str_replace('\\', '/', $class).'.php',
                   str_replace('\\', '/', $class).'.php',
                  '$DIR_PSR4/'.str_replace('\\', '/', $class).'.php',
                  '$DIR_LIB/'.str_replace('\\', '/', $class).'.php',
           );
           
           $name = 'class '.$class;
           
          foreach($fnames as $fn){
		  	$_p = $this->get_file($this->document, $fn, $name);
		  	if(false !== $_p){
				$this->_run_php_1($_p, $class);
				//return $_p;
				return true;
			}
		  } 
           
        return false;   
	}
	 
    public function lint(?bool $lint = null) : bool {
		 if(is_bool($lint)){
			$this->_lint=$lint; 
		 }
		return $this->_lint;
    }
	 
	public function _run_php_1($part, $class = null, ?bool $lint = null){
	
	
	//	set_time_limit(min(900, ini_get('max_execution_time') + 300));
			if(!isset($_ENV['FRDL_HPS_CACHE_DIR'])){
			  $_ENV['FRDL_HPS_CACHE_DIR'] = getenv('FRDL_HPS_CACHE_DIR');	
			}
		
		
		$cacheDir = (!empty($_ENV['FRDL_HPS_CACHE_DIR'])) ? rtrim($_ENV['FRDL_HPS_CACHE_DIR'], \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-includes' 
						: rtrim( \sys_get_temp_dir(), \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-includes';
		
		$cacheDirLint = (!empty($_ENV['FRDL_HPS_CACHE_DIR'])) ? rtrim($_ENV['FRDL_HPS_CACHE_DIR'], \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-lint' 
						: rtrim( \sys_get_temp_dir(), \DIRECTORY_SEPARATOR.'/\\').\DIRECTORY_SEPARATOR.'temp-lint';
		
		
		 if(!is_bool($lint)){
			$lint=$this->lint(); 
		 }	
		
		$code = $part->getBody();
		
		
  $code = trim($code);
  if('<?php' === substr($code, 0, strlen('<?php')) ){
	  $code = substr($code, strlen('<?php'), strlen($code));
  }
  $code = rtrim($code, '<?php> ');
  $codeWithStartTags = "<?php "."\n".$code."\n".'?>';	
		
	//	$codeWithStartTags ='<?php'."\n".$code;
		
				  
		$name = $class;
		    if(!is_string($name)){
				$name = $part->getName();
			}
		
		    if(!is_string($name)){
				$name = $part->getFileName();
			}
		
		
		$fehler =      true === $lint  
			       &&  class_exists(\frdl\Lint\Php::class, $class !== \frdl\Lint\Php::class)
			       &&  class_exists(\webfan\hps\patch\PhpBinFinder::class, $class !== \webfan\hps\patch\PhpBinFinder::class) 
			       &&  class_exists(\Symfony\Component\Process\ExecutableFinder::class, $class !== \Symfony\Component\Process\ExecutableFinder::class) 
			       &&  class_exists(\Symfony\Component\Process\PhpExecutableFinder::class, $class !== \Symfony\Component\Process\PhpExecutableFinder::class) 
			    ? (new \frdl\Lint\Php($cacheDirLint) ) ->lintString($codeWithStartTags)
			    : true;
		
		if(true !==$fehler ){
			$e='Error in '.__METHOD__.' ['.__LINE__.']'.print_r($fehler,true).'<br />$class: '.$name.'<pre>'.htmlentities($codeWithStartTags).'</pre>'.$part->getFileName().' '.$part->getName();
		    trigger_error($e);			
		}else{
			 return eval($code);	
		}
		
		
	 //	try{
		 //   return eval($code);			
	   //  }catch(\Exception $e){						
		 //	$er='Error in '.$name.'<pre>'.htmlentities($codeWithStartTags).'</pre>'.' '.__METHOD__.' ['.__LINE__.'|'.$e->getLine().']'.$e->getMessage();		
		 //  trigger_error($er);		
	 //	}	
		
		
	/*	
			$cacheFile = 
				tempnam($cacheDir, 
						'eval.runtime.'.preg_replace("/[^\w\d]/", "_", $name).'.');
	     	
		     if(!file_exists(dirname($cacheFile))){
				 mkdir(dirname($cacheFile), 0755, true);
			 }
		
		
		    $handle = fopen($cacheFile, "w+");
            fwrite($handle, $codeWithStartTags);
            fclose($handle);
		
		try{
			if(file_exists($cacheFile)){
				$result = require $cacheFile;
				unlink($cacheFile);
				return $result;
			}else{
			    return eval($code);
			}
	    }catch(\Exception $e){						
			$er='Error in '.$name.'<pre>'.htmlentities($codeWithStartTags).'</pre>'.' '.__METHOD__.' ['.__LINE__.'|'.$e->getLine().']'.$e->getMessage();
			// print_r($e);
		   // trigger_error($e);
			throw new \Exception($er);
		}		
		*/
	}
	 
	 	
 	public function __construct($file = null, $offset = 0){
 		$this->buf = &$this;
 		
 	 	if(null===$file)$file=__FILE__;
 	 	$this->__FILE__ = $file;
 	 	if(__FILE__===$this->__FILE__){
			$this->offset = $this->getAttachmentOffset(); 
		}else{
			$this->offset = $offset;
		}

        $this->initial_offset = $this->offset;
		
		
		//$this->php = array(
		//     '<?' => array(
		//     
		//     ),
		//     '#!' => array(
		//     
		 //    ),
		//     '#' => array(
		//     
		 //    ),
		//);
		
	//	MimeStubApp::God()->addStreamWrapper( 'frdl', 'mime', $this,  true  ) ;
 	}
 	
 	
 	
 	
 	final public function __destruct(){
			
	//	try{
			 if(is_resource($this->IO))fclose($this->IO);

	//	}catch(\Exception $e){
	//		trigger_error($e->getMessage(). ' in '.__METHOD__,  $this->e_level);
	//	}
	}
	
	
	
	
   public function __set($name, $value)
    {
    	if('location'===$name){
    		$code =$this->__toString();
			$code =str_replace(base64_decode('X19oYWx0X2NvbXBpbGVyKE1pbWU='), '__halt_compiler();Mime', $code);			
			$code =str_replace(base64_decode('X19oYWx0X2NvbXBpbGVyKClNbWltZQ=='), '__halt_compiler();Mime', $code);			
			$code =str_replace(base64_decode('X19oYWx0X2NvbXBpbGVyKClNaW1l'), '__halt_compiler();Mime', $code);	
			file_put_contents($value, $code);
			return null;
		}
    	
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __set(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
            
            
         return null;
    }    
    	 
	 
	 
    public function getAttachmentOffset(){
	    return __COMPILER_HALT_OFFSET__;
    } 
    
    
   public function __toString()
   {
 	 	  // 	$document = $this->document;	
	 		  $code = $this->exports;	
	 		  if(__FILE__ === $this->__FILE__) 	{
			   	 $php = substr($code, 0, $this->getAttachmentOffset());
			  }else{
			  	 $php = substr($code, 0, $this->initial_offset);
			  }
	 		 
	 		 
	 		 // $php = str_replace('define(\'___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___\', true);', 'define(\'___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___\', false);', $php);
    		$php = str_replace('define(\'\\___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___\', true);', '', $php);
    		$php = str_replace('define(\'___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___\', true);', '', $php);
      		
	        
	     $mime = $this->document;
    	
	     $newNamespace = "App\compiled\Instance\MimeStub2\MimeStubEntity".mt_rand(1000000,999999999);
	   
	 
	   /*
    	    $php = preg_replace("/(".preg_quote('namespace App\compiled\Instance\MimeStub\MimeStubEntity218187677;').")/", 
								'namespace '.\webfan\hps\Module::MODULE_NAMESPACE_FROM.';',
								  $php);
	   
	//  $__FILE__ = 	   'web+fan://mime.stub.frdl/'.$newNamespace;	
	
	 
	 
	  $Compiler = new \webfan\hps\Compile\ModulePhpFile(0, 0, $php );
	

	   
 // $Compiler->setConstant('__FILE__', '__FILE__', '__FILE__');		                                                       
 // $Compiler->setConstant('__DIR__','__DIR__', '__DIR__');


  $Compiler->setReplaceNamespace(\webfan\hps\Module::MODULE_NAMESPACE_FROM,$newNamespace);							  
  $Compiler->code($php);
  $php = $Compiler->compile();
	  */
    	    $php = preg_replace("/(".preg_quote('namespace '.__NAMESPACE__.'{').")/", 
								'namespace '.$newNamespace.'{',
								  $php);	   

	   
	   
				 $php = $php.$mime;				  

	 	return $php;
   }   
      
     
  public function __get($name)
    {

     switch($name){
	 	case 'exports':	 
	 		return $this->getFileAttachment($this->__FILE__, 0);
	 	break;
	 	case 'location':	 
	 		return $this->__FILE__;
	 	break;
	 	case 'document':
	 		if(false===$this->raw){
	 			$this->raw=$this->getFileAttachment($this->__FILE__, $this->initial_offset);
	 		}
	 		if(false===$this->MIME){
	 			$this->MIME=MimeStub2::create($this->raw);
	 		}
	 		return $this->MIME;
	 	break;
	 	
	 	
	 //	case 'request':	 
	// 		return $this->Request;
	// 	break;
	 /*		
	 	case 'context':	 
	 		return $this->Context;
	 	break;
	 		
	 	case 'response':	 
	 		return $this->Response;
	 	break;
	 */	
	 	default:
         return null;	 	
	 	break;
	 }

         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
            
            
         return null;
    }
   
   
	
    public function __invoke()
    {
    	$args = func_get_args();
 	
	 		if(false===$this->raw){
	 			$this->raw=$this->getFileAttachment($this->__FILE__, $this->initial_offset);
	 		}
	 		if(false===$this->MIME){
	 			$this->MIME=MimeStub2::create($this->raw);
	 		}
 		
		   	
 		//$this->Request = new Request();
 		//$this->Env = new Env();
	//	$this->Context = new Context();
	//	$this->Response = new Response();
		$res = &$this;
		
        if(0<count($args)){
        $i=-1;
		foreach($args as $arg){
		  $i++;
		  	
		  	/*
				//if(is_object($arg) && get_class($this->Request)===get_class($arg)){
			//		$this->Request = &$arg;
			//	}else
				if(is_object($arg) && get_class($this->Env)===get_class($arg)){
					$this->Env = &$arg;
				}elseif(is_object($arg) && get_class($this->Context)===get_class($arg)){
					$this->Context = &$arg;
				}elseif(is_object($arg) && get_class($this->Response)===get_class($arg)){
					$this->Response = &$arg;
				}
				
	    if(is_array($arg)){
             $this->Context = new Context($arg);
		}
		*/
		if(is_string($arg)){
    		$cmd = $arg;
    		if('run'===$arg){
				$res = call_user_func_array(array($this, '_run'), $args);
			}else{
    		
			$u = parse_url($cmd);
			$c = explode('.',$u['host']);
		    $c = array_reverse($c);
		    $tld = array_shift($c);
		    $f = false;
			if('frdl'===$u['scheme']){
				if('mime'===$tld){
					if(!isset($args[$i+1])){
						$res = $this->getFileAttachment($cmd, 0);
						$f = true;
					}else if(isset($args[$i+1])){
						//@todo write
					}
				}
			}	
			
			 if(false===$f){
			 	//todo...
			 	//if('#'===substr($cmd, 0, 1)){
               //      $this->php['#'][]=$cmd;
				//}elseif('#!'===substr($cmd, 0, 2)){
				//     $this->php['#!'][]=$cmd;
				//}elseif('<?'===substr($cmd, 0, 2)){
				//    $this->php['<?'][]=$cmd;
				//}else{
			 		$parent = (isset($this->MIME->parent) && null !== $this->MIME->parent) ? $this->MIME->parent : null;
					$this->MIME=MimeStub2::create($cmd, $parent);					
			//	}
			 }
			}

		}			
				
			}
		}elseif(0===count($args)){
			$res = &$this->buf;
		}
				      	

 	
    	
       return $res;
    }      
 	protected function _run(){
 	    $this->runStubs();
 	 	return $this;
 	} 	
 	
   public function __call($name, $arguments)
    {
    	
 	  return call_user_func_array(array($this->document, $name), $arguments);

    }
	
	
 

    public function getFileAttachment($file = null, $offset = null){
    	if(null === $file)$file = &$this->file;
    	if(null === $offset)$offset = $this->offset;
    	
		$IO = fopen($file, 'r');
		
        fseek($IO, $offset);
        try{
			$buf =  stream_get_contents($IO);
			if(is_resource($IO))fclose($IO);
		}catch(\Exception $e){
			$buf = '';
			if(is_resource($IO))fclose($IO);
			trigger_error($e->getMessage(),  $this->e_level);
		}
        
        return $buf;
	}	
	
	
   
 }


/**
*  https://github.com/Riverline/multipart-parser 
* 
* Class Part
* @package Riverline\MultiPartParser
* 
*  Copyright (c) 2015-2016 Romain Cambien
*  
*  Permission is hereby granted, free of charge, to any person obtaining a copy
*  of this software and associated documentation files (the "Software"),
*  to deal in the Software without restriction, including without limitation
*  the rights to use, copy, modify, merge, publish, distribute, sublicense,
*  and/or sell copies of the Software, and to permit persons to whom the Software
*  is furnished to do so, subject to the following conditions:
*  
*  The above copyright notice and this permission notice shall be included
*  in all copies or substantial portions of the Software.
*  
*  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
*  INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
*  IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
*  DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
*  ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
*  OTHER DEALINGS IN THE SOFTWARE.
* 
*  - edited by webfan.de
*/


  
class MimeStub2 implements StubItemInterface
{
 const NS = __NAMESPACE__;
 const DS = DIRECTORY_SEPARATOR;
 const FILE = __FILE__;
 const DIR = __DIR__;
		
 const numbers = '0123456789';
 const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
 const specials = '!$%^&*()_+|~-=`{}[]:;<>?,./';
 
 
 
 	
	protected static $__i = -1;


	//protected $_parent;
    
    
    protected $_id = null;
    protected $_p = -1;   
    
    
    /**
     * @var array
     */
    protected $headers;

    /**
     * @var string
     */
    protected $body;
    
    protected $_parent = null;

    /**
     * @var Part[]
     */
    protected $parts = array();

    /**
     * @var bool
     */
    protected $multipart = false;


    protected $modified = false;
    
    protected $contentType = false;
    protected $encoding = false;
    protected $charset = false;
    protected $boundary = false;
    

   
   
   
protected function _defaultsRandchars ($opts = array()) {
  $opts = array_merge(array(
      'length' =>  8,
      'numeric' => true,
      'letters' => true,
      'special' => false
  ), $opts);
  return array(
    'length' =>  (is_int($opts['length'])) ? $opts['length'] : 8,
    'numeric' => (is_bool($opts['numeric'])) ? $opts['numeric'] : true,
    'letters' => (is_bool($opts['letters'])) ? $opts['letters'] : true,
    'special' =>  (is_bool($opts['special'])) ? $opts['special'] : false
  );
}

protected function _buildRandomChars ($opts = array()) {
   $chars = '';
  if ($opts['numeric']) { $chars .= self::numbers; }
  if ($opts['letters']) { $chars .= self::letters; }
  if ($opts['special']) { $chars .= self::specials; }
  return $chars;
}

public function generateBundary($opts = array()) {
  $opts = $this->_defaultsRandchars($opts);
  $i = 0;
  $rn = '';
      $rnd = '';
      $len = $opts['length'];
      $randomChars = $this->_buildRandomChars($opts);
  for ($i = 1; $i <= $len; $i++) {
  	$rn = mt_rand(0, strlen($randomChars) -1);
  	$n = substr($randomChars, $rn,  1);
    $rnd .= $n;
  }
 
 return $rnd;
}   
    
    
    public function __set($name, $value)
    {
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __set(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
            
            
         return null;
    }    
    
    
  public function __get($name)
    {
       // echo "Getting '$name'\n";
      //  if (array_key_exists($name, $this->data)) {
      //      return $this->data[$name];
      //  }
     switch($name){
     	case 'disposition' :
     	    return $this->getHeader('Content-Disposition');
     	    break;
	 	case 'parent':	 
	 		return $this->_parent;
	 	break;
	 	case 'id':	 
	 		return $this->_id;
	 	break;
	 	case 'nextChild':	
	 	    $this->_p=++$this->_p;
	 	    if($this->_p >= count($this->parts)/* -1*/)return false; 
	 		return (is_array($this->parts)) ? $this->parts[$this->_p] : null;
	 	break;
	 	case 'next':	 
	 		return $this->nextChild;
	 	break;
	 	case 'rewind':	 
	 	    $this->_p=-1;
	 		return $this;
	 	case 'root':	 
	 	    if(null === $this->parent || (get_class($this->parent) !== get_class($this)))return $this;
	 		return $this->parent->root;
	 	break;
	 	case 'isRoot':	 
	 		return ($this->root->id === $this->id) ? true : false;
	 	break;
	 	case 'lastChild':	 
	 		return (is_array($this->parts)) ? $this->parts[count($this->parts)-1] : null;
	 	break;
	 	case 'firstChild':	 
	 		return (is_array($this->parts) && isset($this->parts[0])) ? $this->parts[0] : null;
	 	break;
	 	
	 	
	 	default:
         return null;	 	
	 	break;
	 }

         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
            
            
         return null;
    }
   
   
     protected function _hashBody(){
        if($this->isMultiPart()){
		//   $this->setHeader('Content-MD5', md5($this));
	 	//   $this->setHeader('Content-SHA1', sha1($this));
		} else{
		   $this->setHeader('Content-MD5', md5($this->body));
	 	   $this->setHeader('Content-SHA1', sha1($this->body));
	 	   $this->setHeader('Content-Length', strlen($this->body));
	 	} 
	 }
    
     protected function _hashBodyRemove(){
		   $this->removeHeader('Content-MD5');
	 	   $this->removeHeader('Content-SHA1');
	 	   $this->removeHeader('Content-Length');
	 }
	 
	      
     public function __call($name, $arguments)
    {
    	
    	if('setBody'===$name){
    		$this->clear();
    		if(!isset($arguments[0]))$arguments[0]='';
    		$this->prepend($arguments[0]);
            return $this;	 
		}elseif('prepend'===$name){
    		if(!isset($arguments[0]))$arguments[0]='';
    		if($this->isMultiPart()){
	    		$this->parts[] = new self($arguments[0], $this);
		    	return $this;				
			}else{
				$this->body = $arguments[0] . $this->body;
				$this->_hashBody();
				return $this;		
			}

		}elseif('append'===$name){
    		if(!isset($arguments[0]))$arguments[0]='';
    		if($this->isMultiPart()){
	    		$this->parts[] = new self($arguments[0], $this);
		    	return $this;				
			}else{
				$this->body .= $arguments[0];
				$this->_hashBody();
				return $this;		
			}

		}elseif('clear' === $name){
			if($this->isMultiPart()){
				$this->parts = array();
			}else{
				$this->body = '';
				$this->_hashBodyRemove();
			}
			return $this;
		}else{
			

		
		
		
    //https://tools.ietf.org/id/draft-snell-http-batch-00.html
    foreach(array('from', 'to', 'cc', 'bcc', 'sender', 'subject', 'reply-to'/* ->{'reply-to'}  */, 'in-reply-to',
    'message-id') as $_header){
      	if($_header===$name){
            if(0===count($arguments)){
				return $this->getHeader($_header, null);
			}elseif(null===$arguments[0]){
				$this->removeHeader($_header);
			}elseif(isset($arguments[0]) && is_string($arguments[0])){
            	$this->setHeader($_header, $arguments[0]);
            }
           return $this;		
		}  
    }	
	
   
   } 
   //else
   
    	
        // Note: value of $name is case sensitive.
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __call(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
            
            
         return null;
    }

    /**  As of PHP 5.3.0  */
    public static function __callStatic($name, $arguments)
    {
    	
     	if('run'===$name){
			return call_user_func_array('run', $arguments);
		}
    	   	
    	
     	if('vm'===$name){
     		if(0===count($arguments)){
				return new MimeVM();
			}elseif(1===count($arguments)){
				return new MimeVM($arguments[0]);
			}elseif(2===count($arguments)){
				return new MimeVM($arguments[0], $arguments[1]);
			}
     	  // return call_user_func_array(array(webfan\MimeVM, '__construct'), $arguments);
     	   return new MimeVM();
		}
    	
	
    	
    	 if('create'===$name){
    	 	if(!isset($arguments[0]))$arguments[0]='';
    	 	if(!isset($arguments[1]))$arguments[1]=null;
		 	return new self($arguments[0], $arguments[1]);
		 }
        // Note: value of $name is case sensitive.
         $trace = debug_backtrace();
         trigger_error(
            'Undefined property via __callStatic(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
            
            
         return null;
    }  
   
    public function getContentType()
    {
    	$this->contentType=$this->getMimeType();
        return $this->contentType;
    }
    
    
    public function headerName($headName)
    {
      $headName = str_replace('-', ' ', $headName);
      $headName = ucwords($headName);
      return preg_replace("/\s+/", "\s", str_replace(' ', '-', $headName));
    }
 
 


    /**
     * @param string $input A base64 encoded string
     *
     * @return string A decoded string
     */
    public static function urlsafeB64Decode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= str_repeat('=', $padlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * @param string $input Anything really
     *
     * @return string The base64 encode of what you passed in
     */
    public static function urlsafeB64Encode($input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }
    
    
 
   public static function strip_body($s,$s1,$s2=false,$offset=0, $_trim = true) {
    /*
    * http://php.net/manual/en/function.strpos.php#75146
    */

 //   if( $s2 === false ) { $s2 = $s1; }
    if( $s2 === false ) { $s2 = $s1.'--'; }
    $result = array();
    $result_2 = array();
    $L1 = strlen($s1);
    $L2 = strlen($s2);

    if( $L1==0 || $L2==0 ) {
        return false;
    }

    do {
        $pos1 = strpos($s,$s1,$offset);

        if( $pos1 !== false ) {
            $pos1 += $L1;

            $pos2 = strpos($s,$s2,$pos1);

            if( $pos2 !== false ) {
                $key_len = $pos2 - $pos1;

                $this_key = substr($s,$pos1,$key_len);
                if(true===$_trim){
					$this_key = trim($this_key);
				}

                if( !array_key_exists($this_key,$result) ) {
                    $result[$this_key] = array();
                }

                $result[$this_key][] = $pos1;
                $result_2[] = array(
                   'pos' => $pos1,
                   'content' => $this_key
                );

                $offset = $pos2 + $L2;
            } else {
                $pos1 = false;
            }
        }
    } while($pos1 !== false );

    return array(
      'pindex' => $result_2, 
      'cindex' => $result
    );
 }


    /**
     * MultiPart constructor.
     * @param string $content
     * @throws \InvalidArgumentException
     */
    protected function __construct($content, &$parent = null)
    {
    	$this->_id = ++self::$__i;
    	$this->_parent = $parent;
    	
        // Split headers and body
        $splits = preg_split('/(\r?\n){2}/', $content, 2);

        if (count($splits) < 2) {
            throw new \InvalidArgumentException("Content is not valid, can't split headers and content");
        }

        list ($headers, $body) = $splits;

        // Regroup multiline headers
        $currentHeader = '';
        $headerLines = array();
        foreach (preg_split('/\r?\n/', $headers) as $line) {
            if (empty($line)) {
                continue;
            }
            if (preg_match('/^\h+(.+)/', $line, $matches)) {
                // Multi line header
                $currentHeader .= ' '.$matches[1];
            } else {
                if (!empty($currentHeader)) {
                    $headerLines[] = $currentHeader;
                }
                $currentHeader = trim($line);
            }
        }

        if (!empty($currentHeader)) {
            $headerLines[] = $currentHeader;
        }

        // Parse headers
        $this->headers = array();
        foreach ($headerLines as $line) {
            $lineSplit = explode(':', $line, 2);
            if (2 === count($lineSplit)) {
                list($key, $value) = $lineSplit;
                // Decode value
                $value = mb_decode_mimeheader(trim($value));
            } else {
                // Bogus header
                $key = $lineSplit[0];
                $value = '';
            }
            // Case-insensitive key
            $key = strtolower($key);
            if (!isset($this->headers[$key])) {
                $this->headers[$key] = $value;
            } else {
                if (!is_array($this->headers[$key])) {
                    $this->headers[$key] = (array)$this->headers[$key];
                }
                $this->headers[$key][] = $value;
            }
        }

        // Is MultiPart ?
        $contentType = $this->getHeader('Content-Type');
        $this->contentType=$contentType;
        if ('multipart' === strstr(self::getHeaderValue($contentType), '/', true)) {
            // MultiPart !
            $this->multipart = true;
            $boundary = self::getHeaderOption($contentType, 'boundary');
            $this->boundary=$boundary;

            if (null === $boundary) {
                throw new \InvalidArgumentException("Can't find boundary in content type");
            }

            $separator = '--'.preg_quote($boundary, '/');

            if (0 === preg_match('/'.$separator.'\r?\n(.+?)\r?\n'.$separator.'--/s', $body, $matches)
              || \preg_last_error() !== \PREG_NO_ERROR
            ) {
              $bodyParts = self::strip_body($body,$separator."",$separator."--",0);
               if(1 !== count($bodyParts['pindex'])){
			 	 throw new \InvalidArgumentException("Can't find multi-part content");
			   }
			   $bodyStr = $bodyParts['pindex'][0]['content'];
			   unset($bodyParts);
            }else{
				$bodyStr = $matches[1];
			}


            

            $parts = preg_split('/\r?\n'.$separator.'\r?\n/', $bodyStr);
            unset($bodyStr);

            foreach ($parts as $part) {
                //$this->parts[] = new self($part, $this);
                $this->append($part);
            }
        } else {
        	
            // Decode
            $encoding = $this->getEcoding();
            switch ($encoding) {
                case 'base64':
                    $body = $this->urlsafeB64Decode($body);
                    break;
                case 'quoted-printable':
                    $body = quoted_printable_decode($body);
                    break;
            }

            // Convert to UTF-8 ( Not if binary or 7bit ( aka Ascii ) )
            if (!in_array($encoding, array('binary', '7bit'))) {
                // Charset
                $charset = self::getHeaderOption($contentType, 'charset');
                if (null === $charset) {
                    // Try to detect
                    $charset = mb_detect_encoding($body) ?: 'utf-8';
                }
                $this->charset=$charset;
            
                // Only convert if not UTF-8
                if ('utf-8' !== strtolower($charset)) {
                    $body = \mb_convert_encoding($body, 'utf-8', $charset);
                }
            }

            $this->body = $body;
        }
    }


      
    public function __toString()
    {
    	$boundary = $this->getBoundary($this->isMultiPart());
    	$s='';
    	foreach($this->headers as $hname => $hvalue){
    		$s.= $this->headerName($hname).': '.  $this->getHeader($hname) /*$hvalue*/."\r\n";
		}
		
		$s.= "\r\n" ;
		if ($this->isMultiPart()) $s.=  "--" ;
		$s.= $boundary ;
		if ($this->isMultiPart()) $s.= "\r\n" ;	
		
		
		if ($this->isMultiPart()) {
            foreach ($this->parts as $part) {            	
               $s.=  (get_class($this) === get_class($part)) ? $part : $part->__toString() . "\r\n" ;
            }
             $s.= "\r\n"."--" . $boundary .  '--';
	    }else{

			$s.= $this->getBody(true, $encoding);
        }		
		
	     if (null!==$this->parent && $this->parent->isMultiPart() && $this->parent->lastChild->id !== $this->id){
            $s.= "\r\n" . "--" .$this->parent->getBoundary() . "\r\n";		
	     }
        return $s;
    }   
    
    public function getEcoding()
    {
    	$this->encoding=strtolower($this->getHeader('Content-Transfer-Encoding'));
        return $this->encoding;
    }
    
    public function getCharset()
    {
      //  return $this->charset;
       $charset = self::getHeaderOption($this->getMimeType(), 'charset');
        if(!is_string($charset)) {
          // Try to detect
          $charset = mb_detect_encoding($this->body) ?: 'utf-8';
        }
      $this->charset=$charset;
      return $this->charset;       
    }
    
     
    public function setBoundary($boundary = null, $opts = array())
    {
       	$this->mod();

    	if(null===$boundary){
 			$size = 8;
			if(4 < count($this->parts))$size = 32;
			if(6 < count($this->parts))$size = 40;
			if(8 < count($this->parts))$size = 64;
			if(10 <= count($this->parts))$size = 70;
			$opt = array(
			  'length' => $size
			);
			

			$options = array_merge($opt, $opts);
			$boundary = $this->generateBundary($options);
		}

			$this->boundary =$boundary;
			$this->setHeaderOption('Content-Type', $this->boundary, 'boundary');		
   }  
    
       
    public function getBoundary($generate = true)
    {
        $this->boundary = self::getHeaderOption($this->getHeader('Content-Type'), 'boundary');
        if(true === $generate && $this->isMultiPart() 
           && (!is_string($this->boundary) || 0===strlen(trim($this->boundary))) 
        ){
        	$this->setBoundary();
		}
        return $this->boundary;
    }   
        /** 
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function mod()
    {
       $this->modified = true;
       return $this;
    }     
    
    public function setHeader($key, $value)
    {
       $this->mod();
       $key = strtolower($key);
       $this->headers[$key]=$value;
       
		//	 echo print_r($this->headers, true);
			 
       return $this;
    }     
     
    public function removeHeader($key)
    {
       $this->mod();
       unset($this->headers[$key]);
       return $this;
    }     
       
   public function setHeaderOption($headerName, $value = null, $opt = null)
    {
       $this->mod();
    	$old_header_value = $this->getHeader($headerName);
     		 		
		
        if(null===$opt && null !==$value){
			 $this->headers[$headerName]=$value;
		}else if(null !==$opt && null !==$value){
             list($headerValue,$options) = self::parseHeaderContent($old_header_value);
             $options[$opt]=$value;
			 $new_header_value = $headerValue;
		 //	$new_header_value='';
			 foreach($options as $o => $v){
			 	$new_header_value .= ';'.$o.'='.$v.'';
			 }

			 $this->setHeader($headerName, $new_header_value);	
		} 
         

       return $this;
    }
    
              

    /**
     * @return bool
     */
    public function isMultiPart()
    {
        return $this->multipart;
    }

    /**
     * @return string
     * @throws \LogicException if is multipart
     */
    public function getBody($reEncode = false, &$encoding = null)
    {
        if ($this->isMultiPart()) {
            throw new \LogicException("MultiPart content, there aren't body");
        } else {
	    	$body = $this->body;
	    	
	     if(true===$reEncode){
            $encoding = $this->getEcoding();
            switch ($encoding) {
                case 'base64':
                    $body = $this->urlsafeB64Encode($body);
                    break;
                case 'quoted-printable':
                    $body = quoted_printable_encode($body);
                    break;
            }

            // Convert to UTF-8 ( Not if binary or 7bit ( aka Ascii ) )
            if (!in_array($encoding, array('binary', '7bit'))) {
                // back de-/encode 
                if (    'utf-8' !== strtolower(self::getHeaderOption($this->getMimeType(), 'charset'))
                     && 'utf-8' === mb_detect_encoding($body)) {
                    $body = mb_convert_encoding($body, self::getHeaderOption($this->getMimeType(), 'charset'), 'utf-8');
                }elseif (    'utf-8' === strtolower(self::getHeaderOption($this->getMimeType(), 'charset'))
                     && 'utf-8' !== mb_detect_encoding($body)) {
                    $body = mb_convert_encoding($body, 'utf-8', mb_detect_encoding($body));
                }
            }   		 	
		 }	
         
            
            return $body; 
        }
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    public function getHeader($key, $default = null)
    {
        // Case-insensitive key
        $key = strtolower($key);
        if (isset($this->headers[$key])) {
            return $this->headers[$key];
        } else {
            return $default;
        }
    }

    /**
     * @param string $content
     * @return array
     */
    static protected function parseHeaderContent($content)
    {
        $parts = explode(';', $content);
        $headerValue = array_shift($parts);
        $options = array();
        // Parse options
        foreach ($parts as $part) {
            if (!empty($part)) {
                $partSplit = explode('=', $part, 2);
                if (2 === count($partSplit)) {
                    list ($key, $value) = $partSplit;
                    $options[trim($key)] = trim($value, ' "');
                } else {
                    // Bogus option
                    $options[$partSplit[0]] = '';
                }
            }
        }

        return array($headerValue, $options);
    }

    /**
     * @param string $header
     * @return string
     */
    static public function getHeaderValue($header)
    {
        list($value) = self::parseHeaderContent($header);

        return $value;
    }

    /**
     * @param string $header
     * @return string
     */
    static public function getHeaderOptions($header)
    {
        list(,$options) = self::parseHeaderContent($header);

        return $options;
    }

    /**
     * @param string $header
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    static public function getHeaderOption($header, $key, $default = null)
    {
        $options = self::getHeaderOptions($header);

        if (isset($options[$key])) {
            return $options[$key];
        } else {
            return $default;
        }
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        // Find Content-Disposition
        $contentType = $this->getHeader('Content-Type');

        return self::getHeaderValue($contentType) ?: 'application/octet-stream';
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        // Find Content-Disposition
        $contentDisposition = $this->getHeader('Content-Disposition');

        return self::getHeaderOption($contentDisposition, 'name');
    }

    /**
     * @return string|null
     */
    public function getFileName()
    {
        // Find Content-Disposition
        $contentDisposition = $this->getHeader('Content-Disposition');

        return self::getHeaderOption($contentDisposition, 'filename');
    }

    /**
     * @return bool
     */
    public function isFile()
    {
        return !is_null($this->getFileName());
    }

    /**
     * @return Part[]
     * @throws \LogicException if is not multipart
     */
    public function getParts()
    {
        if ($this->isMultiPart()) {
            return $this->parts;
        } else {
            throw new \LogicException("Not MultiPart content, there aren't any parts");
        }
    }

    /**
     * @param string $name
     * @return Part[]
     * @throws \LogicException if is not multipart
     */
    public function getPartsByName($name)
    {
        $parts = array();

        foreach ($this->getParts() as $part) {
            if ($part->getName() === $name) {
                $parts[] = $part;
            }
        }

        return $parts;
    }
    
    
    
    
    
    
    
    	public function addFile($type = 'application/x-httpd-php', $disposition = 'php', $code, $file/* = '$__FILE__/filename.ext' */, $name/* = 'stub stub.php'*/){
	 
		
       //   if(null===$parent){
	//		$parent = &$this;
	//	 }
/*		
            $code = trim($code); 		

		    $N = new self($this->newFile($type, $disposition, $file, $name), $parent);		    
		    $N->setBody($code);
		    if(\webfan\hps\Format\Validate::isbase64($code) ){
				 $N->setHeader('Content-Transfer-Encoding', 'BASE64');
			}
		    $N->setBoundary($N->getBoundary($N->isMultiPart()));
		
	     //	$parent->append($N);
		 */
		// $parent->append( $this->newFile($type, $disposition, $file, $name, $code) );
		    $class = get_class($this);
		    $N = new $class($this->newFile($type, $disposition, $file, $name, $code), $parent);		    
		 //   $N->setBody($code);
		   // $N->setBoundary($N->getBoundary($N->isMultiPart()));
		    $this->append($N);
		
		return $this;
	}    	 
	
public function newFile($type = 'application/x-httpd-php', $disposition = 'php', $file = '$HOME/index.php', $name = 'stub stub.php', $code = ''){
	
if(null === $boundary){
  $boundary = $this->getBoundary($this->isMultiPart());
}

	while($code === $boundary){
        $boundary = $this->generateBoundary([
			    'length' =>  max(min(8, strlen($code)), 32),
                'numeric' => true,
                'letters' => true,
                'special' => false
			]);
		 $this->setBoundary($boundary);
	}


$codeWrap ='';
	

				   
if(is_string($type)){	
$codeWrap.= <<<HEADER
Content-Disposition: "$disposition" ; filename="$file" ; name="$name"
Content-Type: $type
HEADER;
}else{
 $codeWrap.= "Content-Disposition: ".$disposition." ; filename=\"".$file."\" ; name=\"".$name."\"";	
}

	
if('application/x-httpd-php' === $type || 'application/vnd.frdl.script.php' === $type){
  $code = trim($code);
  if('<?php' === substr($code, 0, strlen('<?php')) ){
	  $code = substr($code, strlen('<?php'), strlen($code));
  }
  $code = rtrim($code, '<?php> ');
  $code = '<?php '.$code.' ?>';	
}
					 
					 
	
$codeWrap.= "\r\n"."\r\n". trim($code);	
	
//$codeWrap.=\PHP_EOL. $code. \PHP_EOL. \PHP_EOL.'--'.$boundary.'--';
//$codeWrap.= \PHP_EOL;	
//$codeWrap.= \PHP_EOL;		  Content-Type: $type ; charset=utf-8 ;boundary="$boundary"   Content-Type: $type ; charset=utf-8 ;boundary="$boundary"
 return $codeWrap;
} 	
	
}

	
	
	
ini_set('display_errors','on');
error_reporting(\E_ERROR | \E_WARNING | \E_PARSE);	
	
\class_alias('\\'.__NAMESPACE__.'\\MimeStub2', '\\'.__NAMESPACE__.'\\MimeStub2v4');

	

if ( !function_exists('sys_get_temp_dir')) {
  function sys_get_temp_dir() {
    if (!empty($_ENV['TMP'])) { return realpath($_ENV['TMP']); }
    if (!empty($_ENV['TMPDIR'])) { return realpath( $_ENV['TMPDIR']); }
    if (!empty($_ENV['TEMP'])) { return realpath( $_ENV['TEMP']); }
    $tempfile=tempnam(__FILE__,'');
    if (file_exists($tempfile)) {
      unlink($tempfile);
      return realpath(dirname($tempfile));
    }
    return null;
  }
} 	
	



call_user_func(function() {
	
$drush_server_home = (function() {
	
$getRootDir;	
 $getRootDir = (function($path = null) use(&$getRootDir){
	if(null===$path){
		$path = $_SERVER['DOCUMENT_ROOT'];
	}

		
 if(''!==dirname($path) && '/'!==dirname($path) //&& @chmod(dirname($path), 0755) 
    &&  true===@is_writable(dirname($path))
    ){
 	return $getRootDir(dirname($path));
 }else{
 	return $path;
 }

 });		
	
  // Cannot use $_SERVER superglobal since that's empty during UnitUnishTestCase
  // getenv('HOME') isn't set on Windows and generates a Notice.
  $home = getenv('HOME');
  if (!empty($home)) {
    // home should never end with a trailing slash.
    $home = rtrim($home, '/');
  }elseif (isset($_SERVER['HOME']) && !empty($_SERVER['HOME'])) {
    // home on windows
    $home = $_SERVER['HOME'];
    // If HOMEPATH is a root directory the path can end with a slash. Make sure
    // that doesn't happen.
    $home = rtrim($home, '\\/');
  }elseif (!empty($_SERVER['HOMEDRIVE']) && !empty($_SERVER['HOMEPATH'])) {
    // home on windows
    $home = $_SERVER['HOMEDRIVE'] . $_SERVER['HOMEPATH'];
    // If HOMEPATH is a root directory the path can end with a slash. Make sure
    // that doesn't happen.
    $home = rtrim($home, '\\/');
  }elseif (isset($_ENV['HOME']) && !empty($_ENV['HOME'])) {
    // home on windows
    $home = $_ENV['HOME'];
    // If HOMEPATH is a root directory the path can end with a slash. Make sure
    // that doesn't happen.
    $home = rtrim($home, '\\/');
  }
	
  return empty($home) ? $getRootDir($_SERVER['DOCUMENT_ROOT']) : $home;
});
	

	
$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] = (isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'])) ? intval($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) : time() - filemtime(__FILE__);
putenv('FRDL_HPS_PSR4_CACHE_LIMIT='.$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']);

//$_ENV['HOME'] = $drush_server_home();
//putenv('HOME='.$_ENV['HOME']);
$_ENV['FRDL_HOME'] = $drush_server_home();
putenv('FRDL_HOME='.$_ENV['FRDL_HOME']);
//putenv('HOME='.$_ENV['FRDL_HOME']);	

$_homeg = str_replace(\DIRECTORY_SEPARATOR, '/', getenv('FRDL_HOME'));
	
	
$_cwd = getcwd(); 	

chdir(getenv('FRDL_HOME'));
	
	
$workspaces = false;

$_dir = getenv('FRDL_HOME') . \DIRECTORY_SEPARATOR . '.frdl';
//if(!is_dir($_dir)){
 $g = (file_exists("frdl.workspaces.php")) ? [realpath("frdl.workspaces.php")] : glob("frdl.workspaces.php");	
 if(0===count($g)){
	 $g = array_merge(glob(str_replace(\DIRECTORY_SEPARATOR, '/', getcwd())."/frdl.workspaces.php"),
					  glob($_homeg."/frdl.workspaces.php"), glob($_homeg."/*/frdl.workspaces.php"), 
					  glob($_homeg."/*/*/frdl.workspaces.php"));
 }
  if(0<count($g)){
	//	$_dir = dirname($g[0]);	
	  $workspaces = require $g[0];
	  if(isset($workspaces['Frdlweb'])){
		$_dir = $workspaces['Frdlweb']['DIR'];		   
	  }else{
		 foreach($workspaces as $name => $w){
			if(isset($w['DIR']) && is_dir($w['DIR'])){
				$_dir = $w['DIR'];
			  break;	  
			}
		 }
	  }
	  
  }
//}
	
	  
	$_ENV['FRDL_WORKSPACE']= rtrim($_dir, '\\/');
	putenv('FRDL_WORKSPACE='.$_ENV['FRDL_WORKSPACE']);

	
	  
 $_f = $_ENV['FRDL_WORKSPACE']. \DIRECTORY_SEPARATOR.'frdl.workspaces.php';
 if(is_array($workspaces) 
	&& (!file_exists("frdl.workspaces.php") || time()-$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] > filemtime("frdl.workspaces.php")) 
	&& is_dir($_ENV['FRDL_WORKSPACE']) && is_file($_f) ){
	 
	// $exports = var_export($workspaces, true);
$code = <<<PHPCODE
<?php
	return require '$_f';		   
PHPCODE;

 file_put_contents("frdl.workspaces.php", $code);	 
 }
	  
	 if(!is_dir($_ENV['FRDL_WORKSPACE'])){
		mkdir($_ENV['FRDL_WORKSPACE'], 0755, true); 
	 }	
	

$_ENV['FRDL_HPS_CACHE_DIR'] = $_dir . \DIRECTORY_SEPARATOR .\get_current_user() . \DIRECTORY_SEPARATOR. 'cache'. \DIRECTORY_SEPARATOR;
putenv('FRDL_HPS_CACHE_DIR='.$_ENV['FRDL_HPS_CACHE_DIR']);
//putenv('TMP='.$_ENV['FRDL_HPS_CACHE_DIR']);
//ini_set('sys_temp_dir', realpath($_ENV['FRDL_HPS_CACHE_DIR']));	
	 if(!is_dir($_ENV['FRDL_HPS_CACHE_DIR'])){
		mkdir($_ENV['FRDL_HPS_CACHE_DIR'], 0755, true); 
	 }


$_ENV['FRDL_HPS_PSR4_CACHE_DIR'] = rtrim($_ENV['FRDL_HPS_CACHE_DIR'], \DIRECTORY_SEPARATOR).\DIRECTORY_SEPARATOR.'psr4'.\DIRECTORY_SEPARATOR;
putenv('FRDL_HPS_PSR4_CACHE_DIR='.$_ENV['FRDL_HPS_PSR4_CACHE_DIR']);

	 if(!is_dir($_ENV['FRDL_HPS_PSR4_CACHE_DIR'])){
		mkdir($_ENV['FRDL_HPS_PSR4_CACHE_DIR'], 0755, true); 
	 }

	


chdir($_cwd);

});

/**
* 
* $run Function
* 
*/
 $run = function($file = null, $doRun = false){
 	$args = func_get_args();

 	$MimeVM = new MimeVM($args[0]);
 	if($doRun){
		set_time_limit(min(900, ini_get('max_execution_time') + 300));
 
	//	if (!headers_sent()){ 	  
//			header_remove(); 	
//		}
		$MimeVM('run');
	}
 	return $MimeVM;
 };
 
 
$included_files = \get_included_files();  
if(((!defined('___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___') || false === ___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___)
	&& (!defined('\___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___') || false === \___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___)
	&& (!in_array(__FILE__, $included_files) || __FILE__===$included_files[0])
   && (explode('?', $_SERVER['REQUEST_URI'])[0] ===  $_SERVER['PHP_SELF'] && basename( $_SERVER['PHP_SELF']) === basename(__FILE__))
	)
    || ('cli'===substr(strtolower(\PHP_SAPI), 0, 3))
  ) {
    $MimeVM = $run(__FILE__, true);
}else{
	 $MimeVM = $run(__FILE__, false);
}

	

class StubRunner implements StubRunnerInterface
{
	protected $MimeVM = null;
	public function __construct(?StubHelperInterface $MimeVM){
		$THAT = &$this;
		$this->MimeVM=$MimeVM;
		
    //  \frdl\i::c()->set( StubRunnerInterface::class,self::class);
		/*
		\frdl\i::c()->set( StubRunnerInterface::class,static function(\UMA\DIC\Container $c){
	       return $c->get(StubRunner::class);
         });	  	  		
		
      \frdl\i::c()->factory(StubHelperInterface::class,static function(\UMA\DIC\Container $c) {
	    //  return $MimeVM;
		  return $c->get(StubRunnerInterface::class)->getStubVM();
       });	  	  		
		
      \frdl\i::c()->factory(self::class,static function(\UMA\DIC\Container $c) use($THAT) {
	      return $THAT;
       });
	   */
	}
 	public function loginRootUser($username = null, $password = null) : bool{
		return \Webfan\App\Shield::getInstance($this->getStub(), \frdl\i::c(), false)->isAdmin(null,true, $username, $password);
	}
	public function isRootUser() : bool{
		return \Webfan\App\Shield::getInstance($this->getStub(), \frdl\i::c(), false)->isAdmin(null,false);
	}
	public function getStubVM() : StubHelperInterface{
		return $this->MimeVM;
	}
	public function getStub() : StubItemInterface{
		return $this->MimeVM->document;
	}
	public function __invoke() :?StubHelperInterface{
		// $vm = $this->MimeVM; 
      //   return $vm('run');
		
		 	//$MimeVM = new MimeVM(__FILE__);
		   // $MimeVM('run');	 
 	//  return $MimeVM;
		$this->MimeVM->runStubs();
		return $this->MimeVM;
	}
	public function getInvoker(){
		return [$this, '__invoke']; 
	}
	public function autoloading() : void{
		// $file_1 = $this->getStubVM()->get_file($this->getStub(), '$STUB/bootstrap.php', 'stub bootstrap.php');
		//print_r($file_1);
		 $this->getStubVM()->_run_php_1( $this->getStubVM()->get_file($this->getStub(), '$STUB/bootstrap.php', 'stub bootstrap.php')); 
		 $this->getStubVM()->_run_php_1( $this->getStubVM()->get_file($this->getStub(), '$HOME/detect.php', 'stub detect.php')); 
		
	//	$AppShield = \Webfan\App\Shield::getInstance($this->getStubVM(), \frdl\i::c());

	}
	
	public function getShield(){
		return \Webfan\App\Shield::getInstance($this->getStub(), \frdl\i::c(), false);
	}
}
	$StubRunner = new StubRunner($MimeVM);

	return $StubRunner;
}//namespace

__halt_compiler();Mime-Version: 1.0
Content-Type: multipart/mixed;boundary=hoHoBundary12344dh
To: example@example.com
From: script@example.com

--hoHoBundary12344dh
Content-Type: multipart/alternate;boundary=EVGuDPPT

--EVGuDPPT
Content-Type: text/html;charset=utf-8

<h1>InstallShield</h1>
<p>Your Installer you downloaded at <a href="http://www.webfan.de/install/">Webfan</a> is attatched in this message.</p>
<p>You may have to run it in your APC-Environment.</p>


--EVGuDPPT
Content-Type: text/plain;charset=utf-8

 -InstallShield-
Your Installer you downloaded at http://www.webfan.de/install/ is attatched in this message.
You may have to run it in your APC-Environment.

--EVGuDPPT
Content-Type: multipart/related;boundary=4444EVGuDPPT
Content-Disposition: php ;filename="$__FILE__/stub.zip";name="archive stub.zip"

--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$STUB/bootstrap.php";name="stub bootstrap.php"




set_time_limit(min(120, intval(ini_get('max_execution_time')) + 120));

//chmod(dirname($this->location), 0755);
//chmod($this->location, 0755);

//sys_temp_dir



spl_autoload_register(array($this,'Autoload'), true, true);

 try{
   $f = 	 $this->get_file($this->document, '$HOME/apc_config.php', 'stub apc_config.php');
   if($f)$config = $this->_run_php_1($f);	
  if(!is_array($config) ){
	$config=[];  
  }
 }catch(\Exception $e){
		$config=[];  
 }


 $configChanged = false;

  if(!isset($config['$HOME']) ){
	  $config['$HOME'] = getenv('FRDL_HOME');
      $configChanged = true;
  }
  
  if(!isset($config['workspace']) ){
	$config['workspace'] = 'frdl.webfan.de';  
      $configChanged = true;
  }

/*
if(true===$configChanged && $f){
   $f->setBody('
    return '.var_export($config, true).';
   ');
   $this->location = $this->location;	
}
	*/	

$workspace = $config['workspace'];   
$version = 'latest'; 

 try{
  $f = $this->get_file($this->document, '$HOME/version_config.php', 'stub version_config.php');	
  if($f)$version = $this->_run_php_1($f);	
  if(is_array($version) && isset($version['version']) ){
	$version=$version['version'];  
  }
 }catch(\Exception $e){
	$version = 'latest'; 
 }
call_user_func(function($version,$workspace){
	if(!class_exists(\Webfan\Psr4Loader\RemoteFromWebfan::class))return;
  $loader = \Webfan\Psr4Loader\RemoteFromWebfan::getInstance($workspace, true, $version, true);
}, $version, $workspace);






\frdl\webfan\Autoloading\SourceLoader::repository('frdl'); 
\frdl\webfan\App::God(true,  \frdl\webfan\Autoloading\Autoloader::class,'AC boot');
\frdl\webfan\Autoloading\SourceLoader::top() -> unregister(array(\frdl\webfan\Autoloading\SourceLoader::top(),'autoloadClassFromServer'));






--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$HOME/apc_config.php";name="stub apc_config.php"
Content-Md5: 95c413f67b8c20860030be244a6a130c
Content-Sha1: 286f3a82f3caa283dbc795d2972e065adb004076
Content-Length: 201


	
			    return array (
  'hashed_password' => '$2y$10$0nQDX4xic.E.AXm9yzjmC.vyg61OmiMGFMmUpFmKlUSFD/1CF.Gba',
  'workspace' => 'frdl.webfan.de',
  'installed_from_hps_blog_id' => 113,
);
				
			
			
--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$HOME/detect.php";name="stub detect.php"
Content-Md5: 5d80996a1b7eb07944a73d8667fcedf0
Content-Sha1: 72c84b21fa429b6882a40ea46870a11a26414b3c
Content-Length: 5265


   \frdl\webfan\App::God(false)->addFunc('refreshPageIf', function(){

  $refreshAfter = 1;
  $conditionFn = null;
  $callback = null;
  $context = new \Adbar\Dot([
    'document' => [
        'html' => [
            'head' => [
                'title' => 'Webfan Initial Setup Updating...',
            ],
            
            'body' => [
            
            ],
                        
        ],
    ],
  
  ]);


 $template = '<!DOCTYPE html>
<html>
<head>
<title>{{document.html.head.title}}</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css; charset=UTF-8">
<meta http-equiv="Content-Script-Type" content="text/javascript; charset=UTF-8">	
<meta name="application-name" content="Webfan" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="lightblue" />
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<!-- <link rel="manifest" type="application/manifest+json" href="/manifest.webapp" /> -->
<link rel="icon" type="image/x-icon" href="https://domainundhomepagespeicher.webfan.de/favicon.ico" />
<link rel="shortcut icon" href="https://domainundhomepagespeicher.webfan.de/favicon.ico" type="image/ico">

<style>
* { margin: 0.1em; margin-left: 0.1em; padding-right: 0.1em; vertical-align:top;} [ng:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], [ng-cloak], .ng-cloak, .x-ng-cloak { display: none !important; }
body {

    background-color: #F9F8F8;
    margin: 4px;
    padding:4px;
   
    font-size:1em;

}
a:link { color:#00238a;text-decoration: underline; }
a:visited { color:#00238a;text-decoration: underline; }
a:hover { text-decoration: underline; }
a:active { text-decoration: underline; }
a#forgot {color:#444444;text-decoration:underline;}
a#forgot:hover { text-decoration:underline; color:#0F0F0F; border-color:#666666; }



#logo1 {position:absolute;top:15px;
    font-family: Tahoma, Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: normal;
    width: auto; text-align:left; }

.centered { border: 0;  width: auto; max-width:75%;margin:40px auto; color: black; padding:10px;border:2px solid #b1c5de; text-align:right;overflow:auto;
 background: url(https://domainundhomepagespeicher.webfan.de/bilder/domainundhomepagespeicher/produkte/kurzbeschreibung/24.251.251THP.produktbild_artikelbeschreibung.jpg) no-repeat;
}
.aligncenter {text-align:center;}
.content {
	width:auto;text-align:left;float:center;

}
</style>
</head>	
<body>	
<div>	



	

	
		


<div class="aligncenter">

<div class="centered">






<div class="content">
 
	
	
	
<div class="d-rel-inline-block f-top" ui-view="topView">

		 <img src="https://cdn.webfan.de/ajax-loader_2.gif" style="border:none;" alt="laoding..." />
		 <strong style="color:red;">Loading...</strong>
			 
</div>
				 
<div class="d-rel-inline-block f-top" ui-view="startView">
	  
</div>
								 
				 
<div class="d-rel-inline-block f-center" ui-view="centerView">		

  {{content}}

</div>				 
				 
	

	

	
	
<div class="d-rel-inline-block f-bottom" ui-view="bottomView">	

		
		
	<error>The Installer is currently maintained.</error>	
	
		
</div>	
		
		
		
	


	




	
	
</div>
</div>


</div>
	
	
	<a target="_installer" style="font-style:italic;float:bottom;" href="https://domainundhomepagespeicher.webfan.de/install/">powered by Webfan/frdlweb</a>
	
</div>	
	

</body>
</html> 
 ';










	$stringArgs = [];
	$fnErrors = 0;
	$fn = [];
	$args = func_get_args();
	foreach($args as $pos=>$arg){
		if(is_int($arg)){
			$refreshAfter = $arg;
		}elseif(is_string($arg) && '' !== $arg){
			array_push($stringArgs, $arg);
		}elseif(is_callable($arg)){
			$fn[]=$arg;
		}elseif(is_array($arg)){
			$context->mergeRecursive($arg);
		}
	}
    
        if(count($stringArgs)>1){
        	$template = array_pop($stringArgs);
		}
		
        if(count($fn)>1){
			$callback = array_pop($fn);
		}
        
        foreach($fn as $conditionFn){
			 if(true!==call_user_func_array($conditionFn, [])){
				$fnErrors++;
			 }
		}
         
         
         
         
       if($fnErrors){
       	  if(isset($context['content'])){
		  	$context['content']='';
		  }
          header('Refresh: ' . $refreshAfter);
		  
          foreach($stringArgs as $text){
		  	$context['content'] .= $text.\PHP_EOL;
		  }
		  
		
		if(count($stringArgs)){	
		
		  echo preg_replace_callback('/\{\{([\w\.^\{\}]+)\}\}/is', function($m) use ($context){
                if($context->has($m[1])){                	
					   return $context->get($m[1]);	
				}else{
                       return $m[0]; 
               }
          }, $template);		
          ob_end_flush();
		}  

		  
		  
          if($callback){
          	 call_user_func_array($callback, []);   				
		  }
	   } 	
});






call_user_func(function(){
 $frdl_polyfill_registered = \frdl_polyfill::defined;	
});

$AppShield = \Webfan\App\Shield::getInstance($this, \frdl\i::c(), false);





	


ini_set('display_errors','on');
error_reporting(\E_ERROR | \E_WARNING | \E_PARSE);	



	

--4444EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$HOME/index.php";name="stub index.php"


$AppShield = \Webfan\App\Shield::getInstance($this, \frdl\i::c(), false);
	
	
	if(isset($_REQUEST['web'])){
	  $_SERVER['REQUEST_URI'] = ltrim(strip_tags($_REQUEST['web']), '/ ');
    }

$p = explode('?', $_SERVER['REQUEST_URI']);
$path = $p[0];


$webfile= $this->get_file($this->document, '$HOME/$WEB'.$path, 'stub '.$path) ;
if(false !==$webfile){
	$p2 = explode('.', $path);
	$p2 = array_reverse($p2);	
	$p3 = explode(';', $webfile->getHeader('Content-Type'));
	
	if('php' === strtolower($p2[0]) || 'application/x-httpd-php'===$p3[0] ){	
		call_user_func_array([$this, '_run_php_1'], [$webfile]);
	}else{
	   ob_end_clean();
	   header('Content-Type: '.$webfile->getMimeType());		
	   echo $webfile->getBody();
	}
	

	
	die();
}else{	
  \Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->index('/');
}





--4444EVGuDPPT--
--EVGuDPPT--
--hoHoBundary12344dh
Content-Type: multipart/related;boundary=3333EVGuDPPT
Content-Disposition: php ;filename="$__FILE__/attach.zip";name="archive attach.zip"

--3333EVGuDPPT
Content-Type: application/x-httpd-php;charset=utf-8
Content-Disposition: php ;filename="$DIR_PSR4/O.php";name="class O"

<?php
 /**
 * Compression Shortcut
 */
class O extends \stdclass{}





--3333EVGuDPPT
Content-Type: multipart/related;boundary=2222EVGuDPPT
Content-Disposition: php ;name="dir $DIR_PSR4"

--2222EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/frdl/A.php";name="class frdl\A"

<?php
/**
 * Copyright  (c) 2015, Till Wehowski
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. All advertising materials mentioning features or use of this software
 *    must display the following acknowledgement:
 *    This product includes software developed by the frdl/webfan.
 * 4. Neither the name of frdl/webfan nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY frdl/webfan ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL frdl/webfan BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * 
 *  @component abstract frdl\A
 * 
 */
 namespace frdl;
 
 abstract class A{
 	
  const FN_ASPECTS = 'aspects';	
     /**
    *  default $SEMRÃƒÂ‚Ã‚Â´s
	*  const  SERVER_ROUTER = {$cmd=SERVER} . {$format} . {$modul} . {$outputbuffers = explode(',')} 
	*/
	const TPL_SERVER_ROUTE = '{$cmd}.{$responseformat}.{$modul}.{$responsebuffers}';
    const SERVER_PAGE = 'SERVER.html.PAGE.buffered';
    const SERVER_HTML = 'SERVER.html.HTML.buffered';
    const SERVER_API = 'SERVER.?.API.format';
    const SERVER_404 = 'SERVER.html.404.buffered';
    const SERVER_JS = 'SERVER.js.JS.compressed,pragma';
    const SERVER_CSS = 'SERVER.css.CSS.compressed,pragma';
    const SERVER_IMG = 'SERVER.img.IMG.compressed,pragma';
	
    const SERVER_DEFAULT = self::SERVER_PAGE;
    	
  protected $ns_pfx = array('?' => array('frdl' => true),
              '$'=> array('frdl' => true), 
              '$'=> array('frdl' => true),
              '!'=> array('frdl' => true), 
              '#'=> array('frdl' => true), 
              '-'=> array('frdl' => true),
              '.'=> array('frdl' => true), 
              '+'=> array('frdl' => false), 
              ',' => array('frdl' => true)
          );	
  protected $wrappers;
  protected $shortcuts;
 	
  
 
  public function addShortCut ($short,  $long, $label = null){

		 
  	 array_walk($this->ns_pfx,function(&$v){
  	 	  if(!isset($v[\frdl\A::FN_ASPECTS])) $v[\frdl\A::FN_ASPECTS] = array(); 	 	
  	 });
  	 
  	    $ns = substr($short, 0, 1);
  	     if(!is_array($this->shortcuts))$this->shortcuts = array();
        $this->shortcuts[$short] = $long;
          
          if(isset($this->ns_pfx[$ns])){
		  	 if(!isset($this->ns_pfx[$ns][self::FN_ASPECTS]) || !is_array($this->ns_pfx[$ns][self::FN_ASPECTS])) $this->ns_pfx[$ns][self::FN_ASPECTS] = array(); 	
		  	 $aspect = array(
		  	   'label' => (is_string($label)) ? $label : $short,
		  	   'short' => $short,
		  	   'long' => $long
		  	 );
		  	$this->ns_pfx[$ns][self::FN_ASPECTS][$short] = $aspect;
		  }
		  
		 return $this;
  } 
	 
	
 /**
 * todo...
 * 
 */	
  protected function apply_fm_flow(){
  	 $args  = func_get_args();
     $THIS = &$this;
     $SELF = &$this;
         	
   \webfan\App::God() 	
      -> {'$'}('?session_started', (function($startIf = true) use ($THIS, $SELF) {
       	$r = false; 
        if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            $r =  session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
          } else {
             $r =  '' === session_id()  ? FALSE : TRUE;
          }
        }
        
        if(true === $startIf && false === $r){
          if(!session_start()){	
            if(isset($THIS) && isset($THIS->debug) && true === $THIS->debug) trigger_error('Cannot start session in '.basename(__FILE__).' '.__LINE__, E_USER_WARNING);
          }
		}
        
        
       return $r ;
        }) );
     

     $func_jsonP = (function($str) use ($THIS, $SELF) {
		 		       	 $r = (isset($THIS) && isset($THIS->data['data_out'])) ? $THIS->data['data_out'] : new \stdclass;
		 		       	 $r->type = 'print';
		 		       	 $r->out = $str;
      	                 $fnregex = "/^[A-Za-z0-9\$\.-_\({1}\){1}]+$/";
      	                 $callback = (isset($_REQUEST['callback']) && preg_match($fnregex, $_REQUEST['callback']))
		                   ? strip_tags($_REQUEST['callback'])
		                   : '';
		                   
		                   
                if($callback === ''){
         	            $o = json_encode($r);
                }  else {
                	       $r->callback = $callback;
                           $o = $callback.'(' . json_encode($r) . ')';
		                }
		                
		        return $o;
		 	});
		 	
		 	
   /**
   * http://php.net/manual/en/function.apache-request-headers.php#116645
   */      	
   \webfan\App::God() 	
      -> {'$'}('?request_headers', function() {
      	     if( function_exists('apache_request_headers') )return apache_request_headers();
                  foreach($_SERVER as $K=>$V){$a=explode('_' ,$K);
                        if(array_shift($a)==='HTTP'){
                           array_walk($a,function(&$v){$v=ucfirst(strtolower($v));});
                           $retval[join('-',$a)]=$V;}
                  } 
             return $retval;
          }
      );
        	
        	
	     \webfan\App::God() 
            -> {'$'}('$.sem.parse', function($sem) use ($THIS, $SELF) {
            	    $str = $SELF::TPL_SERVER_ROUTE;
            	    foreach($sem as $k => $v){
						$s = (is_array($v)) ? implode(',', $v) : $v;
						$str = str_replace('{$'.$k.'}', $s, $str);
					}
            	    return $str;
            	})
            	// '{$cmd}.{$responseformat}.{$modul}.{$responsebuffers}'; 	
            -> {'$'}('$.sem.unparse', function(&$sem, $route) use ($THIS, $SELF) {
            	    $seg = explode('.', $route);
            	    $sem['cmd'] =  array_shift($seg);
            	    $sem['responseformat'] =  array_shift($seg);
            	    $sem['modul'] =   array_shift($seg);
            	    $sem['responsebuffers'] = explode(',',array_shift($seg));
            	    $sem['.nodes'] =$seg;
                    return $THIS;
            	})
            	
            	
            -> {'$'}('$.sem->getFomatterMethod', (function($format){
            	 if('jsonp' !== $format && 'json' !== $format)return false;
                     return '$.sem.format->'.$format;
            	}))	
            -> {'$'}('$.sem.format->json', $func_jsonP )
            -> {'$'}('$.sem.format->jsonp', $func_jsonP)  
            /**
			* todo   css,txt,php,bin,dat,js,img,....
			*/
            -> {'$'}('$.sem.get->mime', (function($format = null, $file = null, $apply = true, $default = '') use ($THIS, $SELF) {
            $file = ((null===$file || !is_string($file)) ? \webdof\wURI::getInstance()->getU()->file : $file); 	
            if(true === $apply)$THIS->format = $default;
            
   	        $mime_types = array(
            '' =>array( 'text/html',),
            'frdl' =>array( 'application/frdl-bin',),
            'jpg' => array('image/jpeg', ),
            'jpeg' => array('image/jpeg',),
            'jpe' => array('image/jpeg',),
            'gif' => array('image/gif',),
            'png' => array('image/png',),
            'bmp' =>array( 'image/bmp',),
            'flv' => array('video/x-flv',),
            'js' => array('application/x-javascript',),
            'json' =>array( 'application/json',),
            'jsonp' =>array( 'application/x-javascript',),
            'tiff' => array('image/tiff',),
            'css' =>array( 'text/css',),
            'xml' => array('application/xml',),
            'doc' => array('application/msword',),
            'docx' => array('application/msword',),
            'xls' =>array( 'application/vnd.ms-excel',),
            'xlm' => array('application/vnd.ms-excel',),
            'xld' => array('application/vnd.ms-excel',),
            'xla' => array('application/vnd.ms-excel',),
            'xlc' => array('application/vnd.ms-excel',),
            'xlw' => array('application/vnd.ms-excel',),
            'xll' => array('application/vnd.ms-excel',),
            'ppt' => array('application/vnd.ms-powerpoint',),
            'pps' => array('application/vnd.ms-powerpoint',),
            'rtf' => array('application/rtf',),
            'pdf' => array('application/pdf',),
            'html' =>array( 'text/html',),
            'htm' => array('text/html',),
            'php' => array('text/html',),
            'txt' => array('text/plain',),
            'mpeg' => array('video/mpeg',),
            'mpg' => array('video/mpeg',),
            'mpe' => array('video/mpeg',),
            'mp3' =>array( 'audio/mpeg3',),
            'wav' => array('audio/wav',),
            'aiff' =>array('audio/aiff',),
            'aif' =>array( 'audio/aiff',),
            'avi' => array('video/msvideo',),
            'wmv' => array('video/x-ms-wmv',),
            'mov' => array('video/quicktime',),
            'zip' =>array( 'application/zip',),
            'tar' => array('application/x-tar',),
            'swf' => array('application/x-shockwave-flash',),
            'odt' => array('application/vnd.oasis.opendocument.text',),
            'ott' => array('application/vnd.oasis.opendocument.text-template',),
            'oth' =>array( 'application/vnd.oasis.opendocument.text-web',),
            'odm' => array('application/vnd.oasis.opendocument.text-master',),
            'odg' => array('application/vnd.oasis.opendocument.graphics',),
            'otg' => array('application/vnd.oasis.opendocument.graphics-template',),
            'odp' =>array( 'application/vnd.oasis.opendocument.presentation',),
            'otp' => array('application/vnd.oasis.opendocument.presentation-template',),
            'ods' => array('application/vnd.oasis.opendocument.spreadsheet',),
            'ots' => array('application/vnd.oasis.opendocument.spreadsheet-template',),
            'odc' => array('application/vnd.oasis.opendocument.chart',),
            'odf' => array('application/vnd.oasis.opendocument.formula',),
            'odb' => array('application/vnd.oasis.opendocument.database',),
            'odi' => array('application/vnd.oasis.opendocument.image',),
            'oxt' => array('application/vnd.openofficeorg.extension',),
            'docx' => array('application/vnd.openxmlformats-officedocument.wordprocessingml.document',),
            'docm' => array('application/vnd.ms-word.document.macroEnabled.12',),
            'dotx' => array('application/vnd.openxmlformats-officedocument.wordprocessingml.template',),
            'dotm' => array('application/vnd.ms-word.template.macroEnabled.12',),
            'xlsx' => array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',),
            'xlsm' => array('application/vnd.ms-excel.sheet.macroEnabled.12',),
            'xltx' => array('application/vnd.openxmlformats-officedocument.spreadsheetml.template',),
            'xltm' => array('application/vnd.ms-excel.template.macroEnabled.12',),
            'xlsb' => array('application/vnd.ms-excel.sheet.binary.macroEnabled.12',),
            'xlam' => array('application/vnd.ms-excel.addin.macroEnabled.12',),
            'pptx' => array('application/vnd.openxmlformats-officedocument.presentationml.presentation',),
            'pptm' => array('application/vnd.ms-powerpoint.presentation.macroEnabled.12',),
            'ppsx' =>array( 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',),
            'ppsm' => array('application/vnd.ms-powerpoint.slideshow.macroEnabled.12',),
            'potx' => array('application/vnd.openxmlformats-officedocument.presentationml.template',),
            'potm' => array('application/vnd.ms-powerpoint.template.macroEnabled.12',),
            'ppam' => array('application/vnd.ms-powerpoint.addin.macroEnabled.12',),
            'sldx' => array('application/vnd.openxmlformats-officedocument.presentationml.slide',),
            'sldm' => array('application/vnd.ms-powerpoint.slide.macroEnabled.12',),
            'thmx' => array('application/vnd.ms-officetheme',),
            'onetoc' => array('application/onenote',),
            'onetoc2' =>array( 'application/onenote',),
            'onetmp' =>array( 'application/onenote',),
            'onepkg' => array('application/onenote',),
            
            'po' => array( 
			         "Content-Type: text/plain; charset=UTF-8;", "Content-Transfer-Encoding: 8bit\n",
			   ),
			//http://pki-tutorial.readthedocs.org/en/latest/mime.html
            'key' => array('application/pkcs8',), 
            'crt' => array('application/x-x509-ca-cert',), //VIRTUAL !!!!
           // 'crt' => array('application/x-x509-user-cert',),
      
            'cer' => array('pkix-cert',), 
           // 'pkicrt' => array('application/x-x509-user-cert',),
            'crl' => array('application/x-pkcs7-crl',),
			'pfx' => array('application/x-pkcs12',),
                        
			'bin' => array( 
			         "Content-Type: application/octet-stream", "Content-Transfer-Encoding: binary\n",
			   ),
			'dat' => array( 
			         "Content-Type: application/octet-stream", "Content-Transfer-Encoding: binary\n",
			         'Content-Disposition:attachment; filename="' . $file. '"',
			   ),
        );            
            
             
        $fnFromatFromHeaders = function() use($mime_types){
        	/**
			* 
			* @todo
			* 
			*/
		    return false;
		    
			  $headers = \webfan\App::God()-> {'?request_headers'}();
            	  if(isset($headers['Accept'])){
					$accepts = explode(',', $headers['Accept']);
					if(count($accepts) === 1){
						$_ = explode('/', $accepts[0]);
						$_ = explode(';', $_[1]);
						$_ = explode('+', $_[0]);
						if('*' !== $_s[0]){
							return ((isset($mime_types[$_s[0]])) ? $_s[0] : false) ;
						}
						
					}				  	
				  }
		    return false;		  
		};
		    
            
           if(null === $format || false === $format || !isset($mime_types[$format])){
           	
           	$fromHeaders = $fnFromatFromHeaders();
           	
		    $_e = explode('.', $file);
            $_e = array_reverse($_e);
            $extension = (count($_e) > 1) ? $_e[0] : '';
            if('?' === $format){
            	$format = $extension;
            	if( !isset($mime_types[$format]) && false !== $fromHeaders){
            	  $format = $fromHeaders;
            	}
            }elseif('?:extension' === $format){
            	$format = $extension;
            }elseif('?:headers' === $format){
            	$format = $fromHeaders;
            }

		   } 
		
		

		if(null !== $format && false !== $format){
			if(true === $apply)$THIS->format = $format;
			return ((isset($mime_types[$format])) ? $mime_types[$format] : false);
		}else{
			return $mime_types;
	    }
     }))
     
     ;
        
         
    
   
        	
       return $this;
	}
 	
 } 




--2222EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/frdl/webfan/App.php";name="class frdl\webfan\App"

<?php
/**
 * 
 * Copyright  (c) 2015, Till Wehowski
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. All advertising materials mentioning features or use of this software
 *    must display the following acknowledgement:
 *    This product includes software developed by the frdl/webfan.
 * 4. Neither the name of frdl/webfan nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY frdl/webfan ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL frdl/webfan BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * 
 *  @author 	Till Wehowski <php.support@webfan.de>
 *  @package    webfan://webfan.App.code
 *  @uri        /v1/public/software/class/webfan/frdl.webfan.App/source.php
 *  @file       frdl\webfan\App.php
 *  @role       project/ Main Application Wrap 
 *  @copyright 	2015 Copyright (c) Till Wehowski
 *  @license 	http://look-up.webfan.de/bsd-license bsd-License 1.3.6.1.4.1.37553.8.1.8.4.9
 *  @license    http://look-up.webfan.de/webdof-license webdof-license 1.3.6.1.4.1.37553.8.1.8.4.5
 *  @link 	http://interface.api.webfan.de/v1/public/software/class/webfan/frdl.webfan.App/doc.html
 *  @OID	1.3.6.1.4.1.37553.8.1.8.8 webfan-software
 *  @requires	PHP_VERSION 5.3 >= 
 *  @requires   webfan://webfan.Autoloading.SourceLoader.code
 *  @api        http://interface.api.webfan.de/v1/public/software/get/1/
 *  @reference  http://www.webfan.de/install/
 *  @implements Singletone
 *  @implements StreamWrapper
 * 
 */
namespace frdl\webfan;

if(!class_exists('\frdl\A') && file_exists(__DIR__ . DIRECTORY_SEPARATOR . '..'.DIRECTORY_SEPARATOR .'A.php')){
	 require __DIR__ . DIRECTORY_SEPARATOR . '..'.DIRECTORY_SEPARATOR .'A.php';
}


class App extends \frdl\A
{
		
	const NS = __NAMESPACE__;
	const DS = DIRECTORY_SEPARATOR;
	
	const LOADER = 'webfan\Loader';
	
	protected static $instance = null;
	
	protected $app;
	
	protected $E_CALL = E_USER_ERROR;
	protected $wrap;
	/**
	* 
	* @public _ - current shortcut [mixed]
	* 
	*/
	public $_; 
	
	/**
	 * Stream Properties
	 */
	public $context = array();
	protected $data;
	protected $chunk;
	public $buflen;
	protected $pos = 0;
	protected $read = 0; 	
	protected $Controller;
	

	
	protected $LoaderClass =null;
	
	protected $public_properties_read =  array('app', 'wrap', 'wrappers', 'shortcuts' ,'LoaderClass');
	
	

	
	protected function __construct($init = false, $LoaderClass = self::LOADER, $name = '', $branch = 'dev-master', 
	   $version = 'v1.0.2-beta.1', $meta = array())
	 {
	    $this->app = new \stdclass;	
            $this->app->name = $name;
	    $this->app->branch = $branch;
	    $this->app->version = $version;
	    $this->app->meta = $meta;
	    $this->wrap = array();
	    $this->shortcuts = array();
            $this->setAutoloader($LoaderClass);
	    if($init === true)$this->init();
	}
	
	
    public function &__get($name)
    {
    	
      $retval = null;	
      if (in_array($name, $this->public_properties_read )){
           $retval = $this->{$name};
           return $retval;
	  }
      
        trigger_error('Not fully implemented yet or unaccesable property: '.get_class($this).'->'.$name,  $this->E_CALL);	

        return $retval;
    }		 


    public static function God($init = false, $LoaderClass = self::LOADER, $name = '', $branch = 'dev-master', 
	   $version = 'v1.0.2-beta.1', $meta = array()){
        return self::getInstance( $init, $LoaderClass, $name, $branch ,   $version, $meta );
   }
	 

  	public function init(){
	 $this->addShortCut('$', array($this,'addShortCut'))
	   
	  ;		
	  
	$this->_ = (function(){
			     return call_user_func_array(array($this,'$'), func_get_args());
		   });
	
     $this->wrap = array( 
		         'c' => array(
				        self::LOADER=>  array($this->LoaderClass, null), 
         		        'webfan\App' =>  array(__CLASS__, null),
				 ),
		         'f' => array( ),
		);

      $this ->applyAliasMap(true)
            ->mapWrappers(null)
			->init_stream_wrappers(true) 
			->Autoloader(true) 
		       ->autoload_register() 
		       -> j()
	        ;
                /**
                 * ToDo: Load Application Config and Components...
                 * */
                 
                 
		return $this;
    }
	
	  
	public function setAlias($component, $alias, $default, $abstract_parent, $interfaces = array()){
		$this->wrap['aliasing']['schema'][$component] = array(
		   'alias' => $alias, 'default' => $default, 'abstract_parent' =>$abstract_parent, 
		   'interfaces' => $interfaces
		 );
		return $this;
	}
	
	//todo : compinent registry
	public function setAliasMap($aliasing = null){
		$this->wrap['aliasing'] = (is_array($aliasing)) ? $aliasing
		 : array( 
				      'schema' => array(
					      '1.3.6.1.4.1.37553.8.1.8.8.5.65.8.1.1' => array('name' => 'Autoloader', 'alias' => self::LOADER, 'default' => &$this->LoaderClass,
					                           'abstract_parent' => 'frdl\webfan\Autoloading\SourceLoader', 
					                           'interfaces' => array() ),
					      '1.3.6.1.4.1.37553.8.1.8.8.5.65.8.1.2' => array('name' => 'Application Main Controller', 'alias' => 'webfan\App','default' => 'frdl\webfan\App',
					                           'abstract_parent' => 'frdl\webfan\App', 
					                           'interfaces' => array() ),
					      '1.3.6.1.4.1.37553.8.1.8.8.5.65.8.1.3' => array('name' => 'cmd parser', 'alias' => 'webfan\Terminal','default' =>'frdl\aSQL\Engines\Terminal\Test',
					                           'abstract_parent' => 'frdl\aSQL\Engines\Terminal\CLI', 
					                           'interfaces' => array() ),
					      '1.3.6.1.4.1.37553.8.1.8.8.5.65.8.1.4' => array('name' => 'BootLoader', 'alias' => 'frdl\AC','default' => 'frdl\ApplicationComposer\ApplicationComposerBootstrap',
					                           'abstract_parent' => 'frdl\ApplicationComposer\ApplicationComposerBootstrap', 
					                           'interfaces' => array() ),
						  '1.3.6.1.4.1.37553.8.1.8.8.5.65.8.1.5' => array('name' => 'API REST CLient', 'alias' => 'frdl\Client\RESTapi', 'default' => 'webdof\Webfan\APIClient',
					                           'abstract' => null, 
					                           'interfaces' => array() ), 
					  ),
				 );
				 
		return $this;		 
	}


    public function mapWrappers($wrappers  = null){
    	$this->wrappers = (is_array($wrappers)) ? $wrappers
    	  : array(  
	     'webfan' => array(
		         'tld' => array(   
				        'code' => 'webfan\Loader',
 
                  ),
		  ),
	      'frdl' => array(  
		  
		  ),
	      'homepagespeicher' => array(
		  
		  ),
	      'frdlweb' => array(  
		  
		  ),
	      'outshop' => array(  
		  
		  ),
	      'startforum' => array(  
		  
		  ),	 
	      
	      'wehowski' => array(  
		  
		  ),		
	      'till' => array(  
		  
		  ),		        
	  );
		
		return $this;		 
   }
	

   public function setAutoloader($LoaderClass = self::LOADER, &$success = false){
      $this->LoaderClass = $LoaderClass;
	  return $this;
   }



    public function init_stream_wrappers($overwrite = true){
 		 foreach($this->wrappers as $protocoll => $wrapper){
		       $this->_stream_wrapper_register($protocoll, $overwrite); 	
	     }
		return $this;
    }
	
		
	public function mapAliasing($apply = false){
		foreach($this->wrap['aliasing']['schema'] as $OID => $map){
			$this->wrap['c'][$map['alias']] = array($map['default'],null, $OID);
			if(true===$apply){
				$this->addClass($map['default'], $map['alias'],TRUE, $success );
			}
		}
		return $this; 	
	}
	
	
   public function Autoloader($expose = false){
     $component = '1.3.6.1.4.1.37553.8.1.8.8.5.65.8.1.1';
	 
	 if(null===$this->LoaderClass){
	  foreach($this->wrap['c'] as $alias => $info){
	 	if($component !== $info[2] || true !== $info[1] )continue;
             $this->LoaderClass = $info[0];
		 break;
	  }
	 }
	$Loader = (class_exists('\\'.$this->LoaderClass) ) ? call_user_func('\\'.$this->LoaderClass.'::top') 
		          : call_user_func('\\'.$this->wrap['aliasing']['schema'][$component]['default'].'::top') ;
				 
	 return (true === $expose) ? $Loader : $this;
   }
	
		
	public function applyAliasMap($retry = false){
    	foreach($this->wrap['c'] as $v => $o){
			if(null === $o[1] || (true === $retry && false === $o[1]))$this->addClass($o[0], $v,true, $success);
		}		 
		return $this; 	
	}

	
	 		
	public function __toString(){
		return (string)$this->app->name;
	}		
	
	
	
   public static function getInstance($init = false, $LoaderClass = self::LOADER, $name = '', $branch = 'dev-master', 
	   $version = 'v1.0.2-beta.1', $meta = array())
     {
       if (NULL === self::$instance) {
           self::$instance = new self($init, $LoaderClass, $name, $branch, $version , $meta);
       }
       return self::$instance;
     }
	 	
		
		
   protected function _fnCallback($name){
		// A
		  if(isset($this->shortcuts[$name])){
		  	   if(is_callable($this->shortcuts[$name]))return $this->shortcuts[$name];
		  } 
			  
			  
			  
		 //B 	  
		  	
		 $name = str_replace('\\','.',$name);

		 if(strpos($name,'.')!==false || strpos($name,'->')!==false || strpos($name,'::')!==false){
		 	  
			 if(strpos($name,'->')===false && strpos($name,'::')===false){
			   $n = explode('.', $name);
			   $method =  array_pop($n);
			   $name = implode('\\', $n);		 	
			   return array($name, $method);
			 }elseif( strpos($name,'->')!==false){
			 	 $n = explode('->', $name, 2);
				 $static = false;
			 }elseif(strpos($name,'::')!==false){
			 	 $n = explode('::', $name, 2);
				 $static = true;
			 }
             
			   $method =  array_pop($n);
			   $n = explode('.', $n[0]);
			   $name = implode('\\', $n);			 
			   return ($static === false) ? array($name, $method) : $name.'::'.$method;
		      		    
		 }
	} 
	 
    public function __call($name, $arguments)
    {
    	
		if(isset($this->wrap['f'][$name])){
    	try{
    	     return call_user_func_array($this->wrap['f'][$name],$arguments);
		}catch(Exeption $e){
		     trigger_error($e->getMesage().' '.__METHOD__.' '.__LINE__, $this->E_CALL);
		}
		}

   
    	try{
    		  $c = $this->_fnCallback($name);
    	      if(is_callable($c))call_user_func_array($c,$arguments);
			  return $this;
		}catch(Exeption $e){
		     trigger_error($e->getMesage().' '.__METHOD__.' '.__LINE__, $this->E_CALL);
			 return $this;
		}		
		
		
		 trigger_error($name.' not defined in '.__METHOD__.' '.__LINE__, $this->E_CALL);
		 return $this;
    }	 
	
	
	
	
	
    public static function __callStatic($name, $arguments)
    {
    	if(isset(self::God(false)->wrap['f'][$name])){
    	try{
    	       return call_user_func_array(self::God(false)->wrap['f'][$name],$arguments);
		}catch(Exeption $e){
		     trigger_error($e->getMesage().' '.__METHOD__.' '.__LINE__, self::God(false)->E_CALL);
		}
		}
		
	
	    try{
	    	  $c = self::God()->_fnCallback($name);
    	      if(is_callable($c))call_user_func_array($c,$arguments);
			  return self::God();
		}catch(Exeption $e){
		     trigger_error($e->getMesage().' '.__METHOD__.' '.__LINE__, self::God(false)->E_CALL);
			  return self::God();
		}	
		
		
		 trigger_error($name.' not defined in '.__METHOD__.' '.__LINE__, $this->E_CALL);
		 return self::God();
    }	
	
	

   public function addStreamWrapper( $protocoll, $tld, $class, $overwrite = true  ) {
          if(!isset($this->wrappers[$protocoll]))$this->wrappers[$protocoll] = array();
          if(!isset($this->wrappers[$protocoll]['tld']))$this->wrappers[$protocoll]['tld'] = array();		  
          $this->wrappers[$protocoll]['tld'][$tld] = $class; 
		  $this->_stream_wrapper_register($protocoll, $overwrite);
          return $this;
    }	
   
   
   public function addClass($Instance, $Virtual, $autoload = TRUE, &$success = null  ) {
    	$success =  ($Instance !== $Virtual) ? class_alias( $Instance, $Virtual, $autoload) : true;
		$this->wrap['c'][$Virtual]= array( (is_object($Instance)) ? get_class($Instance) : $Instance, $success);
        return $this;
    }
   
	public function addFunc($name, \Closure $func){
		$this->wrap['f'][$name] = $func; 
		return $this; 	
	}
	
   
   protected function _stream_wrapper_register($protocoll, $overwrite = true, &$success = null){
   		         if (in_array($protocoll, stream_get_wrappers())) {
		         	        if(true !== $overwrite){
                                $success = false;
								return $this;
						    }		         	        		
		         	        stream_wrapper_unregister($protocoll);	
				 }
		        $success = stream_wrapper_register($protocoll, get_class($this));	 
		return $this; 	
   }


	
	
	
	/**
	 * Streaming Methods
	 */	
   public function stream_open($url, $mode, $options = STREAM_REPORT_ERRORS, &$opened_path = null){
    	$u = parse_url($url);
	    $c = explode('.',$u['host']);
		$c = array_reverse($c);
		
		$this->Controller = null;
		$cN = (isset(self::God()->wrappers[$u['scheme']]['tld'][$c[0]]))
		          ?self::God()->wrappers[$u['scheme']]['tld'][$c[0]]
				  :false;
		
		if(false!==$cN){
			try{
			  $this->Controller = new $cN;
			}catch(Exception $e){
				trigger_error($e->getMessage(), E_USER_NOTICE);
				return false;
			}
		}else{
				trigger_error('Stream handler for '.$url.' not found.', E_USER_NOTICE);
				return false;	
		}
				
    	return  call_user_func(array($this->Controller, __FUNCTION__),$url, $mode, $options );
    }
    public function dir_closedir(){return  call_user_func(array($this->Controller, __FUNCTION__) );}
    public function dir_opendir($path , $options){return  call_user_func(array($this->Controller, __FUNCTION__), $path , $options );}
    public function dir_readdir(){return  call_user_func(array($this->Controller, __FUNCTION__) );}
    public function dir_rewinddir(){return  call_user_func(array($this->Controller, __FUNCTION__) );}
    public function mkdir($path , $mode , $options){return  call_user_func(array($this->Controller, __FUNCTION__), $path , $mode , $options );}
    public function rename($path_from , $path_to){return  call_user_func(array($this->Controller, __FUNCTION__), $path_from , $path_to );}
    public function rmdir($path , $options){return  call_user_func(array($this->Controller, __FUNCTION__), $path , $options );}
    public function stream_cast($cast_as){return  call_user_func(array($this->Controller, __FUNCTION__), $cast_as );}
    public function stream_close(){return  call_user_func(array($this->Controller, __FUNCTION__) );}
    function stream_eof(){return  call_user_func(array($this->Controller, __FUNCTION__) );}
    public function stream_flush(){return  call_user_func(array($this->Controller, __FUNCTION__) );}
    public function stream_lock($operation){return  call_user_func(array($this->Controller, __FUNCTION__), $operation );}
    public function stream_set_option($option , $arg1 , $arg2){return  call_user_func(array($this->Controller, __FUNCTION__), $option , $arg1 , $arg2 );}
    public function stream_stat(){return  call_user_func(array($this->Controller, __FUNCTION__) );}
    public function unlink($path){return  call_user_func(array($this->Controller, __FUNCTION__), $path );}
    public function url_stat($path , $flags){return  call_user_func(array($this->Controller, __FUNCTION__), $path , $flags );}
    function stream_read($count){return  call_user_func(array($this->Controller, __FUNCTION__), $count );}
    function stream_write($data){return  call_user_func(array($this->Controller, __FUNCTION__), $data) ;}
    function stream_tell(){return  call_user_func(array($this->Controller, __FUNCTION__) );}
    function stream_seek($offset, $whence){return  call_user_func(array($this->Controller, __FUNCTION__), $offset, $whence );}
    function stream_metadata($path, $option, $var){return  call_user_func(array($this->Controller, __FUNCTION__), $path, $option, $var);}
     
	
}


--2222EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/frdl/common/Stream.php";name="class frdl\common\Stream"

<?php
/**
 * Copyright  (c) 2015, Till Wehowski
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. Neither the name of frdl/webfan nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY frdl/webfan ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL frdl/webfan BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 *  shared by yannick http://php.net/manual/de/class.streamwrapper.php#92277
 * 
 */
namespace frdl\common;
 
interface Stream
{
     function stream_open($url, $mode, $options = STREAM_REPORT_ERRORS, &$opened_path = null);
     public function dir_closedir();
     public function dir_opendir($path , $options);
     public function dir_readdir();
     public function dir_rewinddir();
     public function mkdir($path , $mode , $options);
     public function rename($path_from , $path_to);
     public function rmdir($path , $options);
 	 public function stream_cast($cast_as);
 	 public function stream_close();
     public function stream_eof();
     public function stream_flush();
     public function stream_lock($operation);
     public function stream_set_option($option , $arg1 , $arg2);
     public function stream_stat();
     public function unlink($path);
     public function url_stat($path , $flags);
     public function stream_read($count);
     public function stream_write($data);
     public function stream_tell();
     public function stream_seek($offset, $whence);
     public function stream_metadata($path, $option, $var);
 
}


--2222EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/frdl/webfan/Autoloading/Loader.php";name="class frdl\webfan\Autoloading\Loader"

<?php
/**
 * 
 * Copyright  (c) 2015, Till Wehowski
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. All advertising materials mentioning features or use of this software
 *    must display the following acknowledgement:
 *    This product includes software developed by the frdl/webfan.
 * 4. Neither the name of frdl/webfan nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY frdl/webfan ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL frdl/webfan BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */
namespace frdl\webfan\Autoloading;
 
abstract class Loader
{
     abstract function  autoload_register  ();
     abstract function  addLoader  ( $Autoloader ,  $throw  =  true ,  $prepend  =  true );
     abstract function  unregister  ( $Autoloader );
     abstract function  addPsr0  ( $prefix ,  $base_dir ,  $prepend  =  true );
     abstract function  addNamespace  ( $prefix ,  $base_dir ,  $prepend  =  true );
     abstract function  addPsr4  ( $prefix ,  $base_dir ,  $prepend  =  true ) ;
     abstract function  Psr4  ( $class ) ;
     abstract function  loadClass  ( $class );
     abstract function  Psr0  ( $class ) ;
     abstract function  routeLoadersPsr0  ( $prefix ,  $relative_class ) ;
     abstract function  setAutloadDirectory  ( $dir ) ;
     abstract function  routeLoaders  ( $prefix ,  $relative_class );
     abstract protected function  inc  ( $file );
     abstract function  classMapping  ( $class ) ;
     abstract function  class_mapping_add  ( $class ,  $file , & $success  =  null );
     abstract function  class_mapping_remove  ( $class ) ;
     abstract function  autoloadClassFromServer  ( $className ) ;
    
   
}


--2222EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/frdl/webfan/Autoloading/SourceLoader.php";name="class frdl\webfan\Autoloading\SourceLoader"

<?php
/**
 * 
 * Copyright  (c) 2015, Till Wehowski
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. All advertising materials mentioning features or use of this software
 *    must display the following acknowledgement:
 *    This product includes software developed by the frdl/webfan.
 * 4. Neither the name of frdl/webfan nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY frdl/webfan ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL frdl/webfan BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * 
 *  @author 	Till Wehowski <php.support@webfan.de>
 *  @package    frdl\webfan\Autoloading\SourceLoader
 *  @uri        /v1/public/software/class/webfan/frdl.webfan.Autoloading.SourceLoader/source.php
 *  @file       frdl\webfan\Autoloading\SourceLoader.php
 *  @role       Autoloader 
 *  @copyright 	2015 Copyright (c) Till Wehowski
 *  @license 	http://look-up.webfan.de/bsd-license bsd-License 1.3.6.1.4.1.37553.8.1.8.4.9
 *  @license    http://look-up.webfan.de/webdof-license webdof-license 1.3.6.1.4.1.37553.8.1.8.4.5
 *  @link 	http://interface.api.webfan.de/v1/public/software/class/webfan/frdl.webfan.Autoloading.SourceLoader/doc.html
 *  @OID	1.3.6.1.4.1.37553.8.1.8.8 webfan-software
 *  @requires	PHP_VERSION 5.3 >= 
 *  @requires   webfan://frdl.webfan.App.code
 *  @api        http://interface.api.webfan.de/v1/public/software/class/webfan/
 *  @reference  http://www.webfan.de/install/
 *  @implements StreamWrapper
 * 
 */
namespace frdl\webfan\Autoloading;
use frdl\common;


class SourceLoader extends Loader
{
    const NS = __NAMESPACE__;
    const DS = DIRECTORY_SEPARATOR;
    const SESSKEY = __CLASS__;			
	/**
	 * PKI
	 */
    const DISABLED = 0;
    const OPENSSL = 1;
    const PHPSECLIB = 2;

    const E_NORSA = 'No RSA library selected or supported';
    const E_NOTIMPLEMENTED = 'Sorry thisd is not implemented yet';    
    

    const B_SIGNATURE = "-----BEGIN SIGNATURE-----\r\n";
    const E_SIGNATURE = "-----END SIGNATURE-----";

    const B_CERTIFICATE = "-----BEGIN CERTIFICATE-----\r\n";
    const E_CERTIFICATE = "-----END CERTIFICATE-----";

    const B_PUBLIC_KEY = "-----BEGIN PUBLIC KEY-----\r\n";
    const E_PUBLIC_KEY = "-----END PUBLIC KEY-----";

    const B_RSA_PRIVATE_KEY = "-----BEGIN RSA PRIVATE KEY-----\r\n";
    const E_RSA_PRIVATE_KEY = "-----END RSA PRIVATE KEY-----";

    const B_KEY = "-----BEGIN KEY-----\r\n";
    const E_KEY = "-----END KEY-----";
 
    const B_LICENSEKEY = "-----BEGIN LICENSEKEY-----\r\n";
    const E_LICENSEKEY = "-----END LICENSEKEY-----";


    public $sid;
	
    protected $lib;
	
	
	 
	/**
	 * Stream Properties
	 */
	protected $Client;
	public $context = array();
	protected $data;
	protected $chunk;
	public $buflen;
	protected $pos = 0;
	protected $read = 0; 
	public static $id_repositroy;
	public static $id_interface;	
	public static $api_user;
	public static $api_pass;	
	protected $eof = false;
	protected $mode;
	
	
        protected $dir_autoload;
	protected static $config_source = array( 
	 'install' =>  false,
         'dir_lib' => false,
         'session' => false,
         'zip_stream' => false,
         'append_eval_to_file' => false,
         
	   );
        protected $autoloaders = array();
        protected $autoloadersPsr0 = array();
	protected $classmap = array();
	protected $isAutoloadersRegistered = false;
		
	protected $interface;
	
	/**
	 *  "Run Time Cache" / Buffer
	 */
	protected static $rtc;
	
	protected static $instances = array();
	
	 
	protected $buf = array(
	  'config' => array(),
          'opt' => array(),
          'sources' => array(),
	);
	
	function __construct($pass = null) 
	 {
	   $this->sid = count(self::$instances);
	   self::$instances[$this->sid] = &$this;	
	   
	   $this->interface = null;	

	   $this->dir_autoload = '';	
	   self::repository(((!isset($_SESSION[self::SESSKEY]['id_repository']))?'frdl':$_SESSION[self::SESSKEY]['id_repository']));	 
	   self::$id_interface =  'public';	 
	   self::$api_user = '';
	   self::$api_pass = '';
	   $this->Defaults(true);
	   $this->set_pass($pass);
	 }


  public function j(){
  	 return \webfan\App::God();
  }
	 
	 
  public static function top(){
  	  if(0 === count(self::$instances))return new self;
  	  return self::getStream(0);
  }	 
	 
	 
  public static function getStream($sid){
  	  return (isset(self::$instances[$sid])) ? self::$instances[$sid] : null;
  }	 	 
	 
  public static function repository($id = null){
  	if($id !== null)$_SESSION[self::SESSKEY]['id_repository'] = $id;
	self::$id_repositroy = &$_SESSION[self::SESSKEY]['id_repository'];
	return self::$id_repositroy;
  }	 
	 
  public function set_interface(Array &$interface = null){
  	 $this->interface = (is_array($interface)) ? $interface : null;
	 return $this;
  }	 
	 
  public function config_source($key = null, $value = null){
  	   if(!is_string($key))return self::$config_source;
	   if(!isset(self::$config_source[$key]))return false;
	   self::$config_source[$key]=$value;
	   if(null===$value)unset(self::$config_source[$key]);
	   $this->config['source'] = &self::$config_source;
	   $this->top()->config['source'] = &self::$config_source;
	   return true;
  }  
	 

	 
  public function Defaults($set = false){
          $config = array( 
  'host' => null,
  'IP' => null,
  'uid' => 0,
  'encrypted' => true,
  'e_method' => 2,
  'c_method' => 1,
  'source' => $this->config_source(),
  'ERROR' => E_USER_WARNING,
  'ini' => array( 
      'display_errors_details' => false,
      'pev' => array( 
           'CUSTOM' => null,
           'REQUEST' => true,
	       'HOST' => $_SERVER['SERVER_NAME'],
	     //  'IPs' => $App->getServerIp(),
	       'PATH' => null,
	   ),
	  ), 
 
     
	); 
	
	
		  
		  if($set === true){
		  	  $this->set_config($config); 	
		  }
		  
		  return array(
		     'config' => $config,
		  );
		
	} 

	protected function set_pass($pass = null){
	   $this->pass = (is_string($pass)) ? $pass : mt_rand(10000,9999999).sha1($_SERVER['SERVER_NAME']).'faldsghdfshfdshjfdhjr5nq7q78bg2nda  jgf jtrfun56m8rtjgfjtfjtzurtnmrt tr765  $bbg r57skgmhmh';
	} 
	
	public function mkp(){
		
		$this->set_pass(null);
	     return $this;
	}
	
	public function set_config(&$config){
		$this->config = (is_array($config)) ? $config : $this->buf['config'];
		if(isset($this->config['source']) && is_array($this->config['source']))self::$config_source = &$this->config['source'];
        return $this;		
	}
	 



    public function installSource($class,&$code, &$error ='', &$config_source = null){
          if($config_source === null)$config_source = &self::$config_source;
      //	   	if($config_source === null)$config_source = $this->config['source'];
    
		if($config_source['install'] !== true)return null;
		if(!isset($code['php']))return false;
		if(isset($code['installed']) && $code['installed'] === true)return true;
		
		if($class !== '\frdl\webfan\Serialize\Binary\bin' && class_exists('\frdl\webfan\Serialize\Binary\bin')){
	     $bs = new \frdl\webfan\Serialize\Binary\bin();
		 $code['doc'] = $bs->unserialize($this->unpack_license($code['d']));			
		}

			 		
		 $error = '';
		 $r = false;
		 
	    if(isset($config_source['dir_lib']) && is_string($config_source['dir_lib']) && is_dir($config_source['dir_lib'])){
	         $dir  = rtrim($config_source['dir_lib'],  self::DS . ' '). self::DS ;	
		     $filename = $dir.str_replace('\\', self::DS, $class).'.php'; 
		     $filename = str_replace('/', DIRECTORY_SEPARATOR,$filename);
		     
		     
			 $dir = dirname($filename).self::DS;	
			 if(!is_dir($dir)){
			   if(!mkdir($dir, 0755, true)){
			   	  $error = 'Cannot create directory '.$dir.' and cannot save class '.$class.' in '.__METHOD__.' '.__LINE__;
			   	  trigger_error($error,E_USER_WARNING);
			   }
			 }		
             
			 if($error === ''){
               $file_header = "/**\n* File generated by frdl Application Composer : class : ".__CLASS__."\n**/\n";
			   $php = '<?php '."\n".$file_header."\n/*\$filemtime = ".time().";\n\$class_documentation = ".var_export((isset($code['doc']))?$code['doc']:array(), true).";*/\n".$code['php']."\n";
			 
			   $fp = fopen($filename, 'wb+');
	           fwrite($fp,$php);
	           fclose($fp);
			   if(file_exists($filename)){
			     $code['installed'] = true;
				 $r = true;  
			   }else{
			      $error = 'Cannot create file '.$filename.' and cannot save class '.$class.' in '.__METHOD__.' '.__LINE__;
			   	  trigger_error($error,E_USER_WARNING);
			   }
			 }
		}
			 
			 
			 
			 
	   return $r;	
    }




	
	public function patch_autoload_function($class){
		if(function_exists('__autoload'))return __autoload($class);
	}
		 
	public function autoload_register(){
		if(false !== $this->isAutoloadersRegistered){
		      trigger_error('Autoloadermapping is already registered.',E_USER_NOTICE);
			  return $this;
		}
        $this->addLoader(array($this,'Psr4'), true, true);	
        $this->addLoader(array($this,'Psr0'), true, false);				
	    $this->addLoader(array($this,'classMapping'), true, false);	
        $this->addLoader(array($this,'patch_autoload_function'), true, false);	
        $this->addLoader(array($this,'autoloadClassFromServer'), true, false);	
        $this->isAutoloadersRegistered = true;
        return $this;
	} 
    
    public function addLoader($Autoloader, $throw = true, $prepend = false){
       spl_autoload_register($Autoloader, $throw, $prepend);
	   return $this;
    }

    public function unregister( $Autoloader)
     {
        spl_autoload_unregister($Autoloader);
		return $this;
     } 	
	 
	 
	/**
	 * Psr-0
	 */ 				 
    public function addPsr0($prefix, $base_dir, $prepend = false)
    {
       $prefix = trim($prefix, '\\') . '\\';
       $base_dir = rtrim($base_dir, self::DS) . self::DS;	   
       if(isset($this->autoloadersPsr0[$prefix]) === false) {
            $this->autoloadersPsr0[$prefix] = array();
        }

      if($prepend) {
            array_unshift($this->autoloadersPsr0[$prefix], $base_dir);
        } else {
            array_push($this->autoloadersPsr0[$prefix], $base_dir);
        }
		
		return $this;
    }
	
	/**
	 * Psr-4
	 */ 			 
    public function addNamespace($prefix, $base_dir, $prepend = false)
    {
       return $this->addPsr4($prefix, $base_dir, $prepend);
    }
    public function addPsr4($prefix, $base_dir, $prepend = false)
    {
    
       $prefix = trim($prefix, '\\') . '\\';
       $base_dir = rtrim($base_dir, self::DS) . self::DS;	   
       if(isset($this->autoloaders[$prefix]) === false) {
            $this->autoloaders[$prefix] = array();
        }
	
      if($prepend) {
            array_unshift($this->autoloaders[$prefix], $base_dir);
        } else {
            array_push($this->autoloaders[$prefix], $base_dir);
        }
		
		return $this;
	}	 
    


    
    public function Psr4($class)
    {
    
        $prefix = $class;
        while (false !== $pos = strrpos($prefix, '\\')) {
            $prefix = substr($class, 0, $pos + 1);
            $relative_class = substr($class, $pos + 1);
            $file = $this->routeLoaders($prefix, $relative_class);
			if ($file) {
                return $file;
            }
            $prefix = rtrim($prefix, '\\');   
        }
		
        return false;       
    } 
    public function loadClass($class)
    {
       return $this->Psr4($class);
    }	
	
	
	
   public function Psr0($class)
    {
        $prefix = $class;
        while (false !== $pos = strrpos($prefix, '\\')) {
            $prefix = substr($class, 0, $pos + 1);
            $relative_class = substr($class, $pos + 1);
            $file = $this->routeLoadersPsr0($prefix, $relative_class);
            if ($file) {
                return $file;
            }
            $prefix = rtrim($prefix, '\\');   
        }
        return false;  
    }
  		
   public function routeLoadersPsr0($prefix, $relative_class)
    {
        if (!isset($this->autoloadersPsr0[$prefix])) {
            return false;
        }
        foreach ($this->autoloadersPsr0[$prefix] as $base_dir) {		
          if (null === $prefix || $prefix.'\\' === substr($relative_class, 0, strlen($prefix.'\\'))) {
            $fileName = '';
            $namespace = '';
            if (false !== ($lastNsPos = strripos($relative_class,  '\\'))) {
                $namespace = substr($relative_class, 0, $lastNsPos);
                $relative_class = substr($relative_class, $lastNsPos + 1);
                $fileName = str_replace('\\', self::DS, $namespace) . self::DS;
            }
            $fileName .= str_replace('_', self::DS, $relative_class) /* . '.php'  */;
            $file = ($base_dir !== null ? $base_dir . self::DS : '') . $fileName;
            if ($this->inc($file)) {
                return $file;
            }
          }
		}
	   return false;
    }		


    public function setAutloadDirectory($dir){
  	   if(!is_dir($dir))return false;
	   $this->dir_autoload = $dir;
	   if(substr($this->dir_autoload,-1,1) !== self::DS)$this->dir_autoload.=self::DS;
	   return true;	
    }	 
  		
    public function routeLoaders($prefix, $relative_class)
    {

        if (!isset($this->autoloaders[$prefix])) {
            return false;
        }
        foreach ($this->autoloaders[$prefix] as $base_dir) {
        	
            $file = $base_dir
                  . str_replace('\\', self::DS, $relative_class)
                  /* . '.php'  */
				   ;

		
            if ($this->inc($file)) {
                return $file;
            }
        }
        return false;
    }	
	
    protected function inc($file)
    {
    	if(substr($file,-4,4) === '.php'){
    		$file = $file; 
    	}else{
    		$file.= '.php';
    	}
		$file2= substr($file,0,-4).'.inc';
	
       if(file_exists($file)) {
             require $file;
            return true;
        }elseif(file_exists($file2)) {
             require $file2;
            return true;
        }
		
		
        return false;
    }	
		 
		 
	
	public function classMapping($class){
		if(isset($this->classmap[$class])){
            if ($this->inc($this->classmap[$class])) {
                return $this->classmap[$class];
            }			
		}
		
		return false;
	}
	
	
	public function class_mapping_add($class, $file, &$success = null){
		if(file_exists($file)){
		    $this->classmap[$class] = $file;
			$success = true;
	    }else{
			$success = false;
	    }
		
	   return $this;
	}
    
	public function class_mapping_remove($class){
		if(isset($this->classmap[$class]))unset($this->classmap[$class]);
	    return $this;
	}	
    		 
		 
		 
	protected function source_check($str){	 
		 $start = 'array';
		 $badwords = array('$',';', '?', '_', 'function ', 'class ');
	
		 foreach($badwords as $num => $s){
		 	if(strpos($str, $s)!== false)return false;
		 }
		 
		 if(substr($str,0,strlen($start)) !== $start)return false;
		 if(!preg_match('/[a-f0-9]{40}/', $str))return false;
		 
		 
		 return true;
	} 
	public function autoloadClassFromServer($className){
	
		  $classNameOrig = $className;
		  if(class_exists($className))return;	
		  if (!in_array('webfan', stream_get_wrappers())){
		  	trigger_error('Streamwrapper webfan is not registered. Call to webfan\App::init() required.', E_USER_ERROR);
			return;
		  }
		  $className = str_replace('\\', '.', $className);
		  $className = ltrim($className, ' .');
		  $RessourceFileName = 'webfan://'.$className.'.code';
		   
		  $fp = fopen($RessourceFileName, 'r');
		  $source = '';
		  if($fp){
		  	clearstatcache(); 
			clearstatcache(true,$RessourceFileName);   
			$stat = fstat($fp);
			$bufsize = ($stat['size'] <= 8192) ? $stat['size'] : 8192;
		  	while(!feof($fp) ){
		        $source .= fread($fp, $bufsize);
			}
		     fclose($fp);
		  }else{
		  	return false;
		  }
		  
		  
		if($source ===false || $source ==='' ){
	   			trigger_error('Cannot get source from the webfan code server ('.$RessourceFileName.')! '.__METHOD__.' '.__LINE__, E_USER_WARNING);
		     	return false;
            }
				  
	    $scheck = $this->source_check($source);			  
		if($scheck !== true){
	   			trigger_error('The source loaded from the code server looks malicious ('.$scheck.' '.$RessourceFileName.')! '.__METHOD__.' '.__LINE__, E_USER_WARNING);
		     	return false;			
		}  
		
		if(eval('$data = '.$source.';')===false){
	   			trigger_error('Cannot process the request to the source server by APIDClient ('.$RessourceFileName.')! '.__METHOD__.' '.__LINE__, E_USER_WARNING);
		     	return false;
            }
		
		$_defaults = $this->Defaults();
		$config =  self::$config_source;//$_defaults["config"];
		$opt = (isset($data['opt'])) ? $data['opt'] : $this->getOpt();
		$code = $data['source'];

        $sources = array();
		$sources[$classNameOrig] = $code; 

        if(is_array($this->interface)){
        	$opt['pass'] = $this->interface['API_SECRET'];
			$opt['rot1'] = $this->interface['rot1'];
			$opt['rot2'] = $this->interface['rot2'];
        }
        

		if($this->loadSources($sources,$opt, $config )===false){
		   		trigger_error('Cannot process the request to the source server by APIDClient ('.$className.')! '.__METHOD__.' '.__LINE__, E_USER_WARNING);
		     	return false;		
		}
		
		return $RessourceFileName;	  
	}
	 

    public function make_pass_3(&$opt){
             if(isset($opt['pwdstate']) && $opt['pwdstate'] === 'decrypted')return true;
             if(isset($opt['pwdstate']) && $opt['pwdstate'] === 'error')return false;
            if(!isset(self::$rtc['CERTS']))self::$rtc['CERTS'] = array();
            $hash = sha1($opt['CERT']);
            $u = parse_url($opt['CERT']);
          $url = $opt['CERT'];
           if(!isset(self::$rtc['CERTS'][$hash]) && ($u === false || !isset(self::$rtc['CERTS'][$url])))
               {
                    if($u !== false && count($u) >1 && !preg_match("/CERTIFICATE/", $opt['CERT']) ){
                     if(isset($u['scheme']) && isset($u['host'])){
                $h = explode('.',$u['host']);
                 $h = array_reverse($h);
                 if($h[0] === 'de' && ($h[1] === 'webfan' || $h[1] === 'frdl' )){
                 if(class_exists('\webdof\Http\Client')){
                 $Http = new \webdof\Http\Client();
                $post = array();
                $send_cookies = array();
                $r = $Http->request($opt['CERT'], 'GET', $post, $send_cookies, E_USER_WARNING);
                }else{
                	$c = file_get_contents($opt['CERT']);
					$r = array();
					$r['status'] = (preg_match("/CERTIFICATE/",$c)) ? 200 : 400;
					$r['body'] = $c;
                }
				
                if(intval($r['status'])===200){
               $CERT = trim($r['body']);
               }else{
                 $opt['pwdstate'] = '404';
                return false;
              }
               }
           }else{
                   $CERT = trim(file_get_contents($opt['CERT']));
                }
                   $key = $url;
                  if(!isset(self::$rtc['CERTS'][$key]))self::$rtc['CERTS'][$key] = array();
                 self::$rtc['CERTS'][$key]['crt'] = $CERT;
             }elseif(preg_match("/CERTIFICATE/", $opt['CERT'])){
             	    $key = $hash;
                    if(!isset(self::$rtc['CERTS'][$key]))self::$rtc['CERTS'][$key] = array();
                    $CERT = utf8_encode($opt['CERT']);
					$CERT=$this->loadPK($CERT);
					if($CERT===false){
				   	  trigger_error('Cannot procces certificate info in '.__METHOD__.' line '.__LINE__, E_USER_WARNING);
					  return false;
				   }
					$CERT=$this->save($CERT, self::B_CERTIFICATE, self::E_CERTIFICATE);
					self::$rtc['CERTS'][$key]['crt'] =$CERT;
				   
              }else{
				   	  trigger_error('Cannot procces certificate info in '.__METHOD__.' line '.__LINE__, E_USER_WARNING);
					  return false;
				   }
                 }elseif(isset(self::$rtc['CERTS'][$hash])){
                     $key = $hash;
                  }elseif(isset(self::$rtc['CERTS'][$url])){
                      $key = $url;
                  }else{
                  	 trigger_error('Cannot procces certificate info in '.__METHOD__.' line '.__LINE__, E_USER_WARNING);
					 return false;
                  }


            $this->setLib(1);
        if(!isset(self::$rtc['CERTS'][$key]['PublicKey'])){
              $PublicKey = $this->getPublKeyByCRT(self::$rtc['CERTS'][$key]['crt']);
             self::$rtc['CERTS'][$key]['PublicKey'] = $PublicKey;
           }
            $success = $this->decrypt($opt['pass'],self::$rtc['CERTS'][$key]['PublicKey'],$new_pass) ;
          if($success === true){
            $opt['pass'] = $new_pass;
           $opt['pwdstate'] = 'decrypted';
            }else{
               $opt['pwdstate'] = 'error';
		      // unset(self::$rtc['CERTS'][$key]);
            }
           return $success;
    } 

    protected function load(&$code, Array &$config = null, &$opt = array('pass' => null, 'rot1' => 5, 'rot2' => 3), $class = null){
	      $p = $this->_unwrap_code(((is_string($code)) ? $code : $code['c']));
		  
		  if(isset($opt['e']) && is_bool($opt['e']))$config['encrypted'] = $opt['e'];
		  if(isset($opt['m']))$config['e_method'] = $opt['m'];		   
		  
 	      if($config['encrypted'] === true && intval($config['e_method']) === 1){
 		   	 trigger_error('The options encryption method is deprecated in '.__METHOD__.' '.__LINE__,$config['ERROR']);
		     return false;		     
 	      }	 
		  
 	      if($config['encrypted'] === true && intval($config['e_method']) === 2){
 		     $p = trim($this->crypt($p, 'decrypt', $opt['pass'], $opt['rot1'], $opt['rot2']));
 	      }	 	
		  
 	      if($config['encrypted'] === true && intval($config['e_method']) === 3){
 	      	 if($this->make_pass_3($opt) == false){
		   	 trigger_error('Cannot decrypt password properly [1] from '.self::$id_repositroy.' for '.$class.' in '.__METHOD__.' '.__LINE__,$config['ERROR']);
		       return false;	      	 	
 	      	 }
 		     $p = trim($this->crypt($p, 'decrypt', $opt['pass'], $opt['rot1'], $opt['rot2']));
 	      }	
		  		  		  	
		   if(isset($code['s']) && $code['s'] !== sha1($p)){
	          	 $errordetail = ($config['ini']['display_errors_details'] === true)
			                  ? '<pre>'.sha1($p).'</pre><pre>'.$code['s'].'</pre><pre>'.$opt['pass'].' '.$opt['rot1'].' '.$opt['rot2'].'</pre>'
			                  : '';	   	
													  
		   	   trigger_error('Cannot decrypt source properly [2] from '.self::$id_repositroy.' for '.$class.' in '.__METHOD__.' '.__LINE__.$errordetail,$config['ERROR']);

			   return false;
		   }
		  
 	       $p = $this->unwrap_namespace($p);	   
		   $code['php'] = $p;
		   try{
	             $parsed = eval($p);
		   }catch(Exception $e){
		   	  $parsed = false;
		   }
          if($parsed === false){
          	 $errordetail = ($config['ini']['display_errors_details'] === true)
			                  ? '<pre>'.htmlentities($p).'</pre>'
			                  : '';
		     trigger_error('Parse Error in '.__METHOD__.' '.__LINE__.$errordetail,$config['ERROR']);
		     return false;
	      } else {
			   unset($code['c']);
		  } 
		  
		  $error = '';
		  $config_source = (isset($config['source'])) ? $config['source'] : self::$config_source;
		  $installed = $this->installSource($class,$code, $error, $config_source);
		  
		//  usleep(75);
		  return true; 	
    }


    public function loadSource(&$code, Array &$config = null, &$opt = array('pass' => null, 'rot1' => 5, 'rot2' => 3), $class = null){
    	 return $this->load($code, $config, $opt, $class );
    }

    public function loadSources(&$sources, &$opt = array('pass' => null, 'rot1' => 5, 'rot2' => 3), Array &$config = null){
       $this->set_config($config); 	
       $this->mkp($config);	
       foreach($sources as $class => $code){
       	  if(class_exists($class))continue;
	      if($this->load($code, $config, $opt, $class) === false){
	      	return false;
	      }
       }
    	
       return true;	
    }
	
	
    public function crypt($data, $command = 'encrypt', $Key = NULL, $offset = 5, $chiffreBlockSize = 3)
	{
	   if($command ===  'encrypt'){
	    	$data = sha1(trim($data)).$data;	
			
			    $k = sha1($Key).$Key;
				
				$str = $data;
				$data = '';
				
				
				for($i=1; $i<=strlen($str); $i++)
				{
					$char 		= substr($str, $i-1, 1);
					$keychar 	= substr($k, ($i % strlen($k))-1, 1);
					$char 		= chr(ord($char)+ord($keychar));
					$data		.= $char;
				}
       }
	   if(!is_numeric($offset)||$offset<0)$offset=0;if(!isset($data)||$data==""||!isset($Key)||$Key==""){return FALSE;}$pos="0";for($i=0;$i<=(strlen($data)-1);$i++){$shift=($offset+$i)*$chiffreBlockSize;while($shift>=256){$shift-=256;}$char=substr($data,$i,1);$char=ord($char)+$shift;if($pos>=strlen($Key)){$pos="0";}$key=substr($Key,$pos,1);$key=ord($key)+$shift;if($command=="decrypt"){$key=256-$key;}$dataBlock=$char+$key;if($dataBlock>=256){$dataBlock=$dataBlock-256;}$dataBlock=chr(($dataBlock-$shift));if(!isset($crypted)){$crypted=$dataBlock;}else{$crypted.=$dataBlock;}$pos++;}
       if($command ===  'decrypt'){
 				$decrypt 	= '';
                $k = sha1($Key).$Key;
			
				for($i=1; $i<=strlen($crypted); $i++)
				{
					$char 		= substr($crypted, $i-1, 1);
					$keychar 	= substr($k, ($i % strlen($k))-1, 1);
					$char 		= chr(ord($char)-ord($keychar));
					$decrypt   .= $char;
				}      	   
       	   $crypted = substr($decrypt,strlen(sha1("1")),strlen($decrypt));
		   $hash_check = substr($decrypt,0,strlen(sha1("1")));
		   if(trim($hash_check) !== sha1($crypted) || sha1($crypted)==='da39a3ee5e6b4b0d3255bfef95601890afd80709'){
		   	 $crypted = false;
		   	 trigger_error('Broken data consistence in '.__METHOD__, E_USER_NOTICE);
		   }
	   }
       return $crypted;
	}	

   
    public function unwrap_namespace($s){
    	$s = preg_replace("/^(namespace ([A-Za-z0-9\_".preg_quote('\\')."]+);){1}/", '${1}'."\n", $s);
		return preg_replace("/(\nuse ([A-Za-z0-9\_".preg_quote('\\')."]+);)/", '${1}'."\n", $s);
    }
    	
    public function _unwrap_code($c){return trim(gzuncompress(gzuncompress(base64_decode(str_replace("\r\n\t","", $c))))," \r\n");}		
    public function unpack_license($l){return gzuncompress(gzuncompress(base64_decode(str_replace("\r\n", "", $l))));} 	
	function __destruct() {foreach(array_keys(get_object_vars($this)) as $value){unset($this->$value);}}
	
	
	/**
	 * PKI
	 */ 

   public function setLib($lib)
     {
        $this->lib = $lib;
	   return $this;
     } 

   public function save($data, $begin = "-----BEGIN SIGNATURE-----\r\n", $end = '-----END SIGNATURE-----')
     {
        return $begin . chunk_split(base64_encode($data)) . $end;
     }


   public function loadPK($str)
     {
       $data = preg_replace('#^(?:[^-].+[\r\n]+)+|-.+-|[\r\n]#', '', $str);
       return preg_match('#^[a-zA-Z\d/+]*={0,2}$#', $data) ? utf8_decode (base64_decode($data) ) : false;
     }

  public function error($error, $mod = E_USER_ERROR, $info = TRUE)
    {
      trigger_error($error.(($info === TRUE) ? ' in '.__METHOD__.' line '.__LINE__ : ''), $mod);
      return FALSE;
    }
    
    
  public function verify($data, $sigBin, $publickey, $algo = 'sha256WithRSAEncryption')
     {
        switch($this->lib)
          {
           case self::OPENSSL :
                  return $this->verify_openssl($data, $sigBin, $publickey, $algo);
                break;

           case self::PHPSECLIB :
                  return $this->verify_phpseclib($data, $sigBin, $publickey, $algo);
                break;
           case self::DISABLED :
           default :
                  return $this->error(self::E_NORSA, E_USER_ERROR);
                break;

          }

     }
    
	    
  public function getPublKeyByCRT($cert)
     {
        switch($this->lib)
          {
           case self::OPENSSL :
                  return $this->getPublKeyByCRT_openssl($cert);
                break;

           case self::PHPSECLIB :
                  return $this->error(self::E_NOTIMPLEMENTED, E_USER_ERROR);
                break;
           case self::DISABLED :
           default :
                  return $this->error(self::E_NORSA, E_USER_ERROR);
                break;

          }

     }
	 
  public function encrypt($data,$PrivateKey,&$out)
     {
        switch($this->lib)
          {
           case self::OPENSSL :
                  return $this->encrypt_openssl($data,$PrivateKey,$out);
                break;
        case self::PHPSECLIB :
                  return $this->error(self::E_NOTIMPLEMENTED, E_USER_ERROR);
                break;
           case self::DISABLED :
           default :
                  return $this->error(self::E_NORSA, E_USER_ERROR);
                break;

          }

     }
	 

  public function decrypt($decrypted,$PublicKey,&$out)
     {
        switch($this->lib)
          {
           case self::OPENSSL :
                  return $this->decrypt_openssl($decrypted,$PublicKey,$out);
                break;
        case self::PHPSECLIB :
                  return $this->error(self::E_NOTIMPLEMENTED, E_USER_ERROR);
                break;
           case self::DISABLED :
           default :
                  return $this->error(self::E_NORSA, E_USER_ERROR);
                break;

          }

     }
	 	 
  protected function encrypt_openssl($data,$PrivateKey,&$out) {  
     $PrivKeyRes = openssl_pkey_get_private($PrivateKey);
     return openssl_private_encrypt($data,$out,$PrivKeyRes); 
  }
  
  protected function decrypt_openssl($decrypted,$PublicKey,&$out) {  
        $pub_key = openssl_get_publickey($PublicKey);
        $keyData = openssl_pkey_get_details($pub_key);
        $pub = $keyData['key'];
        $successDecrypted = openssl_public_decrypt(base64_decode($decrypted),$out,$PublicKey, OPENSSL_PKCS1_PADDING);
		return $successDecrypted; 
  }
  


  protected function getPublKeyByCRT_openssl($cert)
    {
       $res = openssl_pkey_get_public($cert);
       $keyDetails = openssl_pkey_get_details($res);
       return $keyDetails['key'];
    }

     

  protected function verify_phpseclib($data, $sigBin, $publickey, $algo = 'sha256WithRSAEncryption')
      {
         $isHash = preg_match("/^([a-z]+[0-9]).+/", $algo, $hashinfo);
         $hash = ($isHash) ? $hashinfo[1] : 'sha256';

         $rsa = new Crypt_RSA();
         $rsa->setHash($hash);
         $rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
         $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
         $rsa->loadKey($publickey);
         return (($rsa->verify($data, $sigBin) === TRUE) ? TRUE : FALSE);
      }


   protected function verify_openssl($data, $sigBin, $publickey, $algo = 'sha256WithRSAEncryption')
      {
        return ((openssl_verify($data, $sigBin, $publickey, $algo) == 1) ? TRUE : FALSE);
      }
	  
	  
	  	
	
	/**
	 * Streaming Methods
	 */
    public function init(){$args = func_get_args(); /** todo ... */ return $this;}
    public function DEFRAG(){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function stream_open($url, $mode, $options = STREAM_REPORT_ERRORS, &$opened_path = null){
    	$u = parse_url($url);
	    $c = explode('.',$u['host']);
		$c = array_reverse($c);
		
		$this->mode = $mode;
		
		if($c[0]==='code')$tld = array_shift($c);
		
		
		
		/**
		 * ToDo: APICLient
		 *    $this->Client = new \frdl\Client\RESTapi();
		 * 
		 *  URL Pattern / e.g. this Class:
		 *  http://interface.api.webfan.de/v1/public/software/class/webfan/frdl.webfan.Autoloading.SourceLoader/source.php
		 * 
		 */
        if(class_exists('\webdof\wHTTP') && class_exists('\webdof\Http\Client') && class_exists('\webdof\Webfan\APIClient')){ 
	      $this->Client = new \webdof\Webfan\APIClient();
		  $this->Client->prepare( 'https',
                          'interface.api.webfan.de',
                          'GET',
                          self::$id_interface,  //  i1234 
                          'software',
                          array(),  //post
                          array(),  //cookie
                          self::$api_user,
                          self::$api_pass,
                          'class',
                          'php',   //format ->hier: "php"
                          'source',
                           array(self::$id_repositroy,implode(".",array_reverse($c))),
                           array(), //get
                          1,
                          E_USER_WARNING);
						  
		 $this->eof = false;
		 $this->pos = 0;
    	 try{
               $r = $this->Client->request();
			   if(intval($r['status']) !== 200)return false;
			   $this->data = $r['body'];
	
		 }catch(Exception $e){
			trigger_error('Cannot process the request to '.$url, E_USER_WARNING);
			return false;
		 }  	
	   }else{
	      $url = 'https://interface.api.webfan.de/v1/'.self::$id_interface.'/software/class/'.self::$id_repositroy.'/'.implode(".",array_reverse($c)).'/source.php';
	     // die($url);
		  $data = file_get_contents($url);
		  if(false === $data){
		  	 return false;			  
		  }else{
		  	 $this->data = $data;
		  }
	   }
				
				
				  
	    return true;					  
    }
    public function dir_closedir(){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function dir_opendir($path , $options){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function dir_readdir(){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function dir_rewinddir(){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function mkdir($path , $mode , $options){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function rename($path_from , $path_to){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function rmdir($path , $options){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
 	public function stream_cast($cast_as){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
 	public function stream_close(){
         $this->Client = null;
	}
    public function stream_eof(){
    	$this->eof = ($this->pos >= strlen($this->data));
    	return $this->eof;
	}
    public function stream_flush(){
    	//echo $this->data;
    	$this->pos  = strlen($this->data);
		return $this->data;
	}
    public function stream_lock($operation){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function stream_set_option($option , $arg1 , $arg2){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function stream_stat(){
		 return array(  
		          'mode' => $this->mode,
		          'size' => strlen($this->data) * 8,
		 );
	}
    public function unlink($path){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function url_stat($path , $flags){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function stream_read($count){
    	 if($this->stream_eof())return  '';
		
    	 $maxReadLength = strlen($this->data) - $this->pos;
         $readLength = min($count, $maxReadLength);

        $p=&$this->pos;
        $ret = substr($this->data, $p, $readLength);
        $p +=  $readLength;
        return (!empty($ret)) ? $ret : '';  	
	}
    public function stream_write($data){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
    public function stream_tell(){return $this->pos;}
    public function stream_seek($offset, $whence){
    	
		
		
		$l=strlen($this->data);
        $p=&$this->pos;
        switch ($whence) {
            case SEEK_SET: $newPos = $offset; break;
            case SEEK_CUR: $newPos = $p + $offset; break;
            case SEEK_END: $newPos = $l + $offset; break;
            default: return false;
        }
        $ret = ($newPos >=0 && $newPos <=$l);
        if ($ret) $p=$newPos;
        return $ret;
	}
    public function stream_metadata($path, $option, $var){trigger_error('Not implemented yet: '.get_class($this).' '.__METHOD__, E_USER_ERROR);}
   
}

--2222EVGuDPPT
Content-Type: application/vnd.frdl.script.php;charset=utf-8
Content-Disposition: php ;filename="$DIR_LIB/frdl/webfan/Autoloading/Autoloader.php";name="class frdl\webfan\Autoloading\Autoloader"

<?php
/**
 * 
 * Copyright  (c) 2015, Till Wehowski
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. All advertising materials mentioning features or use of this software
 *    must display the following acknowledgement:
 *    This product includes software developed by the frdl/webfan.
 * 4. Neither the name of frdl/webfan nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY frdl/webfan ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL frdl/webfan BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */
namespace frdl\webfan\Autoloading;
use frdl\common;
use frdl\common\Lazy;


final class Autoloader extends SourceLoader implements \frdl\common\Stream
{
	
}

--2222EVGuDPPT--
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$HOME/version_config.php" ; name="stub version_config.php"
Content-Type: application/x-httpd-php

<?php return array (
  'time' => 1589426130,
  'version' => '0.0.8.5251281',
); ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Lint/Php.php" ; name="class frdl\Lint\Php"
Content-Type: application/x-httpd-php

<?php  

namespace frdl\Lint;

class Php
{

 protected $cacheDir = null;	
	
 public function __construct($cacheDir = null){
    $this->cacheDir = $cacheDir;
 }
	
	
  public function setCacheDir($cacheDir = null){
	  $this->cacheDir = $cacheDir;
	  return $this;
 }
	
	
 public function getCacheDir(){
	 if(null!==$this->cacheDir && !empty($this->cacheDir)){
	    return $this->cacheDir;
	 }
	 
   if(!isset($_ENV['FRDL_HPS_CACHE_DIR']))$_ENV['FRDL_HPS_CACHE_DIR']=getenv('FRDL_HPS_CACHE_DIR');	 

	  $this->cacheDir = 
		(  isset($_ENV['FRDL_HPS_CACHE_DIR']) && !empty($_ENV['FRDL_HPS_CACHE_DIR']))
		  ? $_ENV['FRDL_HPS_CACHE_DIR'] 
                   : sys_get_temp_dir() . \DIRECTORY_SEPARATOR . get_current_user(). \DIRECTORY_SEPARATOR . 'cache' . \DIRECTORY_SEPARATOR ;	  
	  
	 $this->cacheDir = rtrim($this->cacheDir, '\\/'). \DIRECTORY_SEPARATOR.'lint';
	 
	 if(!is_dir($this->cacheDir)){
		mkdir($this->cacheDir, 0755, true); 
	 }
	 
	 
	  return $this->cacheDir;
 }
	
 public function lintString($source){
	 $tmpfname = tempnam($this->getCacheDir(), 'frdl_lint_php');
	 file_put_contents($tmpfname, $source);
	 $valid = $this->checkSyntax($tmpfname, false);
	 unlink($tmpfname);
	 return $valid;
 }

 public function lintFile($fileName, $checkIncludes = true){	   
	// $o = new self;
	// $o->setCacheDir($o->getCacheDir());
	 return call_user_func_array([$this, 'checkSyntax'], [$fileName, $checkIncludes]);
 }
	
 public static function lintStringStatic($source){
	 $o = new self;
	 $tmpfname = tempnam($o->getCacheDir(), 'frdl_lint_php');
	 file_put_contents($tmpfname, $source);
	 $valid = $o->checkSyntax($tmpfname, false);
	 unlink($tmpfname);
	 return $valid;
 }

 public static function lintFileStatic($fileName, $checkIncludes = true){	 	 
	 $o = new self;
	 $o->setCacheDir($o->getCacheDir());
	 return call_user_func_array([$o, 'checkSyntax'], [$fileName, $checkIncludes]);
 }   
	
	
 public static function __callStatic($name, $arguments){
	 $o = new self;
	 return call_user_func_array([$o, $name], $arguments);
 }	
	
	
 public function checkSyntax($fileName, $checkIncludes = false){
        // If it is not a file or we can't read it throw an exception
      // if(!is_file($fileName) || !is_readable($fileName))
	  if(!file_exists($fileName))
            throw new \Exception("Cannot read file ".$fileName);
       
        // Sort out the formatting of the filename
       $fileName = realpath($fileName);
       
        // Get the shell output from the syntax check command
        $output = shell_exec(sprintf('%s -l "%s"',  (new \webfan\hps\patch\PhpBinFinder())->find(), $fileName));
       
        // Try to find the parse error text and chop it off
        $syntaxError = preg_replace("/Errors parsing.*$/", "", $output, -1, $count);
       
        // If the error text above was matched, throw an exception containing the syntax error
        if($count > 0)
            //throw new \Exception(trim($syntaxError));
			return 'Errors parsing '.print_r([$output, $count],true);
       
        // If we are going to check the files includes
        if($checkIncludes)
        {
            foreach($this->getIncludes($fileName) as $include)
            {
                // Check the syntax for each include
				$tCheck = $this->checkSyntax($include, $checkIncludes);
               if(true!==$tCheck){
				 return $tCheck;   
			   }
            }
        }
	 
	  return true;
    }
   
   public function getIncludes($fileName)
    {
        // NOTE that any file coming into this function has already passed the syntax check, so
        // we can assume things like proper line terminations
           
        $includes = array();
        // Get the directory name of the file so we can prepend it to relative paths
        $dir = dirname($fileName);
       
        // Split the contents of $fileName about requires and includes
        // We need to slice off the first element since that is the text up to the first include/require
        $requireSplit = array_slice(preg_split('/require|include/i', file_get_contents($fileName)), 1);
       
        // For each match
        foreach($requireSplit as $string)
        {
            // Substring up to the end of the first line, i.e. the line that the require is on
            $string = substr($string, 0, strpos($string, ";"));
           
            // If the line contains a reference to a variable, then we cannot analyse it
            // so skip this iteration
            if(strpos($string, "$") !== false)
                continue;
           
            // Split the string about single and double quotes
            $quoteSplit = preg_split('/[\'"]/', $string);
           
            // The value of the include is the second element of the array
            // Putting this in an if statement enforces the presence of '' or "" somewhere in the include
            // includes with any kind of run-time variable in have been excluded earlier
            // this just leaves includes with constants in, which we can't do much about
            if($include = $quoteSplit[1])
            {
                // If the path is not absolute, add the dir and separator
                // Then call realpath to chop out extra separators
                if(strpos($include, ':') === FALSE)
                    $include = realpath($dir.\DIRECTORY_SEPARATOR.$include);
           
                array_push($includes, $include);
            }
        }
       
        return $includes;
    }
	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/webfan/hps/patch/PhpBinFinder.php" ; name="class webfan\hps\patch\PhpBinFinder"
Content-Type: application/x-httpd-php

<?php 
/*
  (new \webfan\hps\patch\PhpBinFinder)->find()
*/

namespace webfan\hps\patch;

use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\PhpProcess;


class PhpBinFinder
{
	public function find(){
		$binFile = (new PhpExecutableFinder)->find();
		if(empty($binFile)){
			$binFile = dirname(dirname(dirname(ini_get('extension_dir')))). \DIRECTORY_SEPARATOR .'bin'. \DIRECTORY_SEPARATOR .'php';	
		}

		$tmpfname = tempnam(\sys_get_temp_dir(), 'phpcheck');
		file_put_contents($tmpfname, "<?php echo 'php\n'; echo \PHP_VERSION.'\n';");
		exec(sprintf('cd %s && %s %s 2>&1 ',dirname($tmpfname), $binFile, $tmpfname), $out, $status); 
		unlink($tmpfname);

		if(isset($out[0]) && 'php' === $out[0]){
 
		}else{ 
			exec('which php 2>&1 ', $out, $status); 
			$binFile = (isset($out[0])) ? $out[0] : '/usr/bin/php';
		}		
	
		return $binFile;
	}	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Webfan/Psr4Loader/RemoteFromWebfan.php" ; name="class Webfan\Psr4Loader\RemoteFromWebfan"
Content-Type: application/x-httpd-php

<?php  


namespace Webfan\Psr4Loader;




class RemoteFromWebfan
{

	protected $selfDomain;
	protected $server;
	protected $domain;
	protected $version;
	protected $allowFromSelfOrigin = false;
	
	protected static $instances = [];
	
	
	function __construct($server = 'frdl.webfan.de', $register = true, $version = 'latest', $allowFromSelfOrigin = false){
		$this->allowFromSelfOrigin = $allowFromSelfOrigin;
		$this->version=$version;
		$this->server = $server;	
		$_self = (isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
		$h = explode('.', $_self);
		$dns = array_reverse($h);
		$this->selfDomain = $dns[1].'.'.$dns[0];
		
		$h = explode('.', $this->server);
		$dns = array_reverse($h);
		$this->domain = $dns[1].'.'.$dns[0];
		
		
		if(!$this->allowFromSelfOrigin && $this->domain === $this->selfDomain){
		  $register = false;	
		}
		
		if(true === $register){
		   $this->register();	
		}		
	}
	
	
  public static function getInstance($server = 'frdl.webfan.de', $register = false, $version = 'latest', $allowFromSelfOrigin = false){
	  if(!isset(self::$instances[$server])){
		  self::$instances[$server] = new self($server, $register, $version, $allowFromSelfOrigin);
	  }
	  
	 return self::$instances[$server];
  }	
	
  public static function __callStatic($name, $arguments){
	  $me = (count(self::$instances)) ? self::$instances[0] : self::getInstance();
	   return call_user_func_array([$me, $name], $arguments);	
  }
	
  public function __call($name, $arguments){
	   if(!in_array($name, ['fetch', 'fetchCode', '__invoke', 'register', 'getLoader', 'Autoload'])){
		  throw new \Exception('Method '.$name.' not allowed in '.__METHOD__);   
	   }
	   return call_user_func_array([$this, $name], $arguments);	
  }	
	
  protected function fetch(){
	  return call_user_func_array([$this, 'fetchCode'], func_get_args());	
  }
	
	
  protected function fetchCode($class, $salt = null){
	if(!is_string($salt)){
		$salt = mt_rand(10000000,99999999);
	}
	  
	  
	$url =	'https://'.$this->server.'/install/?salt='.$salt.'&source='. $class.'&version='.$this->version;


	$options = [
		'https' => [
           'method'  => 'GET',
            'ignore_errors' => true,        
  
		   ]
	];
    $context  = stream_context_create($options);
    $code = @file_get_contents($url, false, $context);
	foreach($http_response_header as $i => $header){
		$h = explode(':', $header);
		if('x-content-hash' === strtolower(trim($h[0]))){
			$hash = trim($h[1]);
		}		
		if('x-user-hash' === strtolower(trim($h[0]))){
			$userHash = trim($h[1]);
		}		
	}	  
	  
	  
    if(false===$code || !isset($hash) || !isset($userHash)){
		return false;
	}
	

	
	$oCode =$code;
	

	$hash_check = strlen($oCode).'.'.sha1($oCode);
	$userHash_check = sha1($salt .$hash_check);	
   
     if(false!==$salt){
	   if($hash_check !== $hash || $userHash_check !== $userHash){
		   throw new \Exception('Invalid checksums while fetching source code for '.$class.' from '.$url);
	   }	   	
     }	

  $code = trim($code);
  if('<?php' === substr($code, 0, strlen('<?php')) ){
	  $code = substr($code, strlen('<?php'), strlen($code));
  }
    $code = trim($code, '<?php> ');
  $codeWithStartTags = "<?php "."\n".$code;	
		
    return $codeWithStartTags;
 }
	
	
	
	public function __invoke(){
	   return call_user_func_array($this->getLoader(), func_get_args());	
	}
	
	protected function register($throw = true, $prepend = false){
		
		if(!$this->allowFromSelfOrigin && $this->domain === $this->selfDomain){
		   throw new \Exception('You should not autoload from remote where you have local access to the source (remote server = host)');
		}		
		
		if(!in_array($this->getLoader(), spl_autoload_functions()) ){
			return spl_autoload_register($this->getLoader(), $throw, $prepend);
		}
	}
	
	protected function getLoader(){
		return [$this, 'Autoload'];
	}
	
  protected function Autoload($class){
	  
	  if(!isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'])){
		$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']=getenv('FRDL_HPS_PSR4_CACHE_LIMIT');  
	  }
	  if(!isset($_ENV['FRDL_HPS_PSR4_CACHE_DIR'])){
		$_ENV['FRDL_HPS_PSR4_CACHE_DIR']=getenv('FRDL_HPS_PSR4_CACHE_DIR');  
	  }
	  
	  
	$cacheFile = ((!empty($_ENV['FRDL_HPS_PSR4_CACHE_DIR'])) ? $_ENV['FRDL_HPS_PSR4_CACHE_DIR'] 
                   : sys_get_temp_dir() . \DIRECTORY_SEPARATOR . \get_current_user(). \DIRECTORY_SEPARATOR . 'cache-frdl' . \DIRECTORY_SEPARATOR. 'psr4'. \DIRECTORY_SEPARATOR
					  )
		          // .  basename($class). '.'. strlen($class) . '.'.sha1($class).'.php';
	            	.  str_replace('\\', \DIRECTORY_SEPARATOR, $class). '.php';
	
 

	
	if(file_exists($cacheFile) 
	   && (!isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'])  
								   || (filemtime($cacheFile) > time() - ((isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) ) ? intval($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) :  3 * 60 * 60)) )){
	   require $cacheFile;
       return true;
	}


	$code = $this->fetchCode($class, null);
	



	if(false !==$code){			
		if(!is_dir(dirname($cacheFile))){			
		  mkdir(dirname($cacheFile), 0755, true);
		}
		
      if(!empty($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) 
		  && file_exists($cacheFile) 
	      && (filemtime($cacheFile) < time() - ((!empty($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) ) ? intval($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) :  3 * 60 * 60)) ){
		     unlink($cacheFile);
      }	
	 //  if(!file_put_contents($cacheFile, $code)){
	  //   throw new \Exception('Cannot write '.$url.' to '.$cacheFile);/*   error_log('Cannot write '.$url.' to '.$cacheFile, \E_WARNING); */
	 //  }
		file_put_contents($cacheFile, $code);
	  		
   }//if(false !==$code)	
	
	
	
	if(file_exists($cacheFile) ){
	    if(false === (require $cacheFile)){
			unlink($cacheFile);
		}
	  	return true;	
	}elseif(false !==$code){ 
		$code = trim($code);  
		if('<?php' === substr($code, 0, strlen('<?php')) ){
			$code = substr($code, strlen('<?php'), strlen($code)); 
		}   
		$code = trim($code, '<?php> ');  
		$codeWithStartTags = "<?php "."\n".$code;	
		eval($code);
		return true;	
	}
			
  }
	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Adbar/Dot.php" ; name="class Adbar\Dot"
Content-Type: application/x-httpd-php

<?php 
/**
 * Dot - PHP dot notation access to arrays
 *
 * @author  Riku SÃƒÂƒÃ‚Â¤rkinen <riku@adbar.io>
 * @link    https://github.com/adbario/php-dot-notation
 * @license https://github.com/adbario/php-dot-notation/blob/2.x/LICENSE.md (MIT License)
 */
namespace Adbar;
use Countable;
use ArrayAccess;
use ArrayIterator;
use JsonSerializable;
use IteratorAggregate;
/**
 * Dot
 *
 * This class provides a dot notation access and helper functions for
 * working with arrays of data. Inspired by Laravel Collection.
 */
class Dot implements ArrayAccess, Countable, IteratorAggregate, JsonSerializable
{
    /**
     * The stored items
     *
     * @var array
     */
    protected $items = [];
    /**
     * Create a new Dot instance
     *
     * @param mixed $items
     */
    public function __construct($items = [])
    {
        $this->items = $this->getArrayItems($items);
    }
    /**
     * Set a given key / value pair or pairs
     * if the key doesn't exist already
     *
     * @param array|int|string $keys
     * @param mixed            $value
     */
    public function add($keys, $value = null)
    {
        if (is_array($keys)) {
            foreach ($keys as $key => $value) {
                $this->add($key, $value);
            }
        } elseif (is_null($this->get($keys))) {
            $this->set($keys, $value);
        }
    }
    /**
     * Return all the stored items
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }
    /**
     * Delete the contents of a given key or keys
     *
     * @param array|int|string|null $keys
     */
    public function clear($keys = null)
    {
        if (is_null($keys)) {
            $this->items = [];
            return;
        }
        $keys = (array) $keys;
        foreach ($keys as $key) {
            $this->set($key, []);
        }
    }
    /**
     * Delete the given key or keys
     *
     * @param array|int|string $keys
     */
    public function delete($keys)
    {
        $keys = (array) $keys;
        foreach ($keys as $key) {
            if ($this->exists($this->items, $key)) {
                unset($this->items[$key]);
                continue;
            }
            $items = &$this->items;
            $segments = explode('.', $key);
            $lastSegment = array_pop($segments);
            foreach ($segments as $segment) {
                if (!isset($items[$segment]) || !is_array($items[$segment])) {
                    continue 2;
                }
                $items = &$items[$segment];
            }
            unset($items[$lastSegment]);
        }
    }
    /**
     * Checks if the given key exists in the provided array.
     *
     * @param  array      $array Array to validate
     * @param  int|string $key   The key to look for
     *
     * @return bool
     */
    protected function exists($array, $key)
    {
        return array_key_exists($key, $array);
    }
    /**
     * Flatten an array with the given character as a key delimiter
     *
     * @param  string     $delimiter
     * @param  array|null $items
     * @param  string     $prepend
     * @return array
     */
    public function flatten($delimiter = '.', $items = null, $prepend = '')
    {
        $flatten = [];
        if (is_null($items)) {
            $items = $this->items;
        }
        foreach ($items as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $flatten = array_merge(
                    $flatten,
                    $this->flatten($delimiter, $value, $prepend.$key.$delimiter)
                );
            } else {
                $flatten[$prepend.$key] = $value;
            }
        }
        return $flatten;
    }
    /**
     * Return the value of a given key
     *
     * @param  int|string|null $key
     * @param  mixed           $default
     * @return mixed
     */
    public function get($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->items;
        }
        if ($this->exists($this->items, $key)) {
            return $this->items[$key];
        }
        if (strpos($key, '.') === false) {
            return $default;
        }
        $items = $this->items;
        foreach (explode('.', $key) as $segment) {
            if (!is_array($items) || !$this->exists($items, $segment)) {
                return $default;
            }
            $items = &$items[$segment];
        }
        return $items;
    }
    /**
     * Return the given items as an array
     *
     * @param  mixed $items
     * @return array
     */
    protected function getArrayItems($items)
    {
        if (is_array($items)) {
            return $items;
        } elseif ($items instanceof self) {
            return $items->all();
        }
        return (array) $items;
    }
    /**
     * Check if a given key or keys exists
     *
     * @param  array|int|string $keys
     * @return bool
     */
    public function has($keys)
    {
        $keys = (array) $keys;
        if (!$this->items || $keys === []) {
            return false;
        }
        foreach ($keys as $key) {
            $items = $this->items;
            if ($this->exists($items, $key)) {
                continue;
            }
            foreach (explode('.', $key) as $segment) {
                if (!is_array($items) || !$this->exists($items, $segment)) {
                    return false;
                }
                $items = $items[$segment];
            }
        }
        return true;
    }
    /**
     * Check if a given key or keys are empty
     *
     * @param  array|int|string|null $keys
     * @return bool
     */
    public function isEmpty($keys = null)
    {
        if (is_null($keys)) {
            return empty($this->items);
        }
        $keys = (array) $keys;
        foreach ($keys as $key) {
            if (!empty($this->get($key))) {
                return false;
            }
        }
        return true;
    }
    /**
     * Merge a given array or a Dot object with the given key
     * or with the whole Dot object
     *
     * @param array|string|self $key
     * @param array|self        $value
     */
    public function merge($key, $value = [])
    {
        if (is_array($key)) {
            $this->items = array_merge($this->items, $key);
        } elseif (is_string($key)) {
            $items = (array) $this->get($key);
            $value = array_merge($items, $this->getArrayItems($value));
            $this->set($key, $value);
        } elseif ($key instanceof self) {
            $this->items = array_merge($this->items, $key->all());
        }
    }
    /**
     * Recursively merge a given array or a Dot object with the given key
     * or with the whole Dot object.
     *
     * Duplicate keys are converted to arrays.
     *
     * @param array|string|self $key
     * @param array|self        $value
     */
    public function mergeRecursive($key, $value = [])
    {
        if (is_array($key)) {
            $this->items = array_merge_recursive($this->items, $key);
        } elseif (is_string($key)) {
            $items = (array) $this->get($key);
            $value = array_merge_recursive($items, $this->getArrayItems($value));
            $this->set($key, $value);
        } elseif ($key instanceof self) {
            $this->items = array_merge_recursive($this->items, $key->all());
        }
    }
    /**
     * Recursively merge a given array or a Dot object with the given key
     * or with the whole Dot object.
     *
     * Instead of converting duplicate keys to arrays, the value from
     * given array will replace the value in Dot object.
     *
     * @param array|string|self $key
     * @param array|self        $value
     */
    public function mergeRecursiveDistinct($key, $value = [])
    {
        if (is_array($key)) {
            $this->items = $this->arrayMergeRecursiveDistinct($this->items, $key);
        } elseif (is_string($key)) {
            $items = (array) $this->get($key);
            $value = $this->arrayMergeRecursiveDistinct($items, $this->getArrayItems($value));
            $this->set($key, $value);
        } elseif ($key instanceof self) {
            $this->items = $this->arrayMergeRecursiveDistinct($this->items, $key->all());
        }
    }
    /**
     * Merges two arrays recursively. In contrast to array_merge_recursive,
     * duplicate keys are not converted to arrays but rather overwrite the
     * value in the first array with the duplicate value in the second array.
     *
     * @param  array $array1 Initial array to merge
     * @param  array $array2 Array to recursively merge
     * @return array
     */
    protected function arrayMergeRecursiveDistinct(array $array1, array $array2)
    {
        $merged = &$array1;
        foreach ($array2 as $key => $value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = $this->arrayMergeRecursiveDistinct($merged[$key], $value);
            } else {
                $merged[$key] = $value;
            }
        }
        return $merged;
    }
    /**
     * Return the value of a given key and
     * delete the key
     *
     * @param  int|string|null $key
     * @param  mixed           $default
     * @return mixed
     */
    public function pull($key = null, $default = null)
    {
        if (is_null($key)) {
            $value = $this->all();
            $this->clear();
            return $value;
        }
        $value = $this->get($key, $default);
        $this->delete($key);
        return $value;
    }
    /**
     * Push a given value to the end of the array
     * in a given key
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function push($key, $value = null)
    {
        if (is_null($value)) {
            $this->items[] = $key;
            return;
        }
        $items = $this->get($key);
        if (is_array($items) || is_null($items)) {
            $items[] = $value;
            $this->set($key, $items);
        }
    }
    /**
     * Replace all values or values within the given key
     * with an array or Dot object
     *
     * @param array|string|self $key
     * @param array|self        $value
     */
    public function replace($key, $value = [])
    {
        if (is_array($key)) {
            $this->items = array_replace($this->items, $key);
        } elseif (is_string($key)) {
            $items = (array) $this->get($key);
            $value = array_replace($items, $this->getArrayItems($value));
            $this->set($key, $value);
        } elseif ($key instanceof self) {
            $this->items = array_replace($this->items, $key->all());
        }
    }
    /**
     * Set a given key / value pair or pairs
     *
     * @param array|int|string $keys
     * @param mixed            $value
     */
    public function set($keys, $value = null)
    {
        if (is_array($keys)) {
            foreach ($keys as $key => $value) {
                $this->set($key, $value);
            }
            return;
        }
        $items = &$this->items;
        foreach (explode('.', $keys) as $key) {
            if (!isset($items[$key]) || !is_array($items[$key])) {
                $items[$key] = [];
            }
            $items = &$items[$key];
        }
        $items = $value;
    }
    /**
     * Replace all items with a given array
     *
     * @param mixed $items
     */
    public function setArray($items)
    {
        $this->items = $this->getArrayItems($items);
    }
    /**
     * Replace all items with a given array as a reference
     *
     * @param array $items
     */
    public function setReference(array &$items)
    {
        $this->items = &$items;
    }
    /**
     * Return the value of a given key or all the values as JSON
     *
     * @param  mixed  $key
     * @param  int    $options
     * @return string
     */
    public function toJson($key = null, $options = 0)
    {
        if (is_string($key)) {
            return json_encode($this->get($key), $options);
        }
        $options = $key === null ? 0 : $key;
        return json_encode($this->items, $options);
    }
    /*
     * --------------------------------------------------------------
     * ArrayAccess interface
     * --------------------------------------------------------------
     */
    /**
     * Check if a given key exists
     *
     * @param  int|string $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }
    /**
     * Return the value of a given key
     *
     * @param  int|string $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }
    /**
     * Set a given value to the given key
     *
     * @param int|string|null $key
     * @param mixed           $value
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->items[] = $value;
            return;
        }
        $this->set($key, $value);
    }
    /**
     * Delete the given key
     *
     * @param int|string $key
     */
    public function offsetUnset($key)
    {
        $this->delete($key);
    }
    /*
     * --------------------------------------------------------------
     * Countable interface
     * --------------------------------------------------------------
     */
    /**
     * Return the number of items in a given key
     *
     * @param  int|string|null $key
     * @return int
     */
    public function count($key = null)
    {
        return count($this->get($key));
    }
    /*
     * --------------------------------------------------------------
     * IteratorAggregate interface
     * --------------------------------------------------------------
     */
     /**
     * Get an iterator for the stored items
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }
    /*
     * --------------------------------------------------------------
     * JsonSerializable interface
     * --------------------------------------------------------------
     */
    /**
     * Return items for JSON serialization
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->items;
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Context.php" ; name="class frdl\Context"
Content-Type: application/x-httpd-php

<?php 
namespace frdl;
class Context
{
  
  protected $context;   
  protected function __construct(){      
     $class = \Adbar\Dot::class;
     $this->context= new $class;
  }
    
  public function __call($name, $arguments) {
      if($this->context->has($name)){
          if(is_callable($this->context->get($name))){
              return call_user_func_array($this->context->get($name), $arguments);
          }
          return $this->context->get($name);
      }
      
      if(is_callable([$this->context, $name])){
          return call_user_func_array([$this->context, $name], $arguments);
      }
      
      return new NotFoundException;
  }
    
  public function &__get($name){
    return ($this->context->has($name)) ?  $this->context->get($name) :  new NotFoundException; 
  }
  
  public function __invoke(\Closure $script) {
      return $script($this->context);      
  }
  public function __set($name, $value) {
      call_user_func_array([$this->context, 'set'], [$name, $value]);  
      return $this;
  } 
  public function flatten() {
     return call_user_func_array([$this->context, 'flatten'], func_get_args());  
  } 	
  public function link(&$items) {
      $this->context->setReference($items);
      return $this;
  }
  public static function create(&$items){      
      $context = new self;
      $context->link($items);
      return $context;
  }
  

 public function import(string $file, bool $throw = null){
	  if(!\is_bool($throw)){
	    $throw = false;	  
	  }
	 
    $exists = \file_exists($file);
    if(!$exists && $throw){
	throw new \Exception(\sprintf('File "%s" does not exist in %s', $file, __METHOD__));    
    }elseif(!$exists){
	return false;    
    }
    $extension = \pathinfo($file, \PATHINFO_EXTENSION); 
  
  if('json' === $extension){	 
    $data = \file_get_contents($file);
    $data = \json_decode($data);
    $data = (array)$data;	  
  }elseif('php' ===\substr($extension,0,\strlen('php'))){
	$data = require $file;  
  }
	 
	foreach($data as $key => $value){
	   $this->context->set($key, $value);
	}
    	
   return true;	 
 }
	
	
  public function export(string $file, string $prepend = null, bool $makeDir = null, bool $throw = null){
	  if(!\is_bool($makeDir)){
	    $makeDir = true;	  
	  }
	  if(!\is_bool($throw)){
	    $throw = true;	  
	  }	  
	  if(!\is_string($prepend)){
	    $prepend = '';	  
	  }	  
	  $dir = \dirname($file);
	//  $exports = \var_export($this->context->all(), true);
	  $exports = \var_export($this->context->flatten('.', null, $prepend), true);
	  $methodDescription = __METHOD__;
	  $time = time();
	  
	  $php = <<<PHPCODE
<?php
/**
* This file was generated automatically by
* @method	$methodDescription
* @time		$time
* @role		data
*/
return $exports;
PHPCODE;
	  
	 $sucess = ( ( \is_dir($dir) && \is_writable($dir) )
		 || (true === $makeDir && @\mdir($dir, 0755, true))
	       )
		 && @\file_put_contents($file, $php);
	  
	  if(true!==$sucess && false !== $throw){
	    throw new \Exception(\sprintf('Error writing "%s" in %s', $file, __METHOD__));	  
	  }	  
	  
   return $sucess;
  }
	
  public function resolvePlaceholder(string $str,array $data = null, string $prefix = '${', string $suffix = '}'){
	  if(null === $data){
		$data =  $this->context ->flatten();
	  }
	  
	  $dataSource = new \Dflydev\PlaceholderResolver\DataSource\ArrayDataSource($data) ;
      $placeholderResolver = new \Dflydev\PlaceholderResolver\RegexPlaceholderResolver($dataSource, $prefix, $suffix);	  
	  return $placeholderResolver->resolvePlaceholder($str);
  }

  public function resolve($payload = null, string $prefix = '${', string $suffix = '}'){
	
	  $data = $this->context ->flatten();
	 	  
	  switch ($payload){
		  case is_string($payload) :
			   $payload =  $this->context->get($payload);
			  break;
		  case is_array($payload) :
			   $data = $payload;
			  break;
		  case null : 
			 default : 
			   $payload =  $data;
			  break;
			  
	  }
	  
	  $dataSource = new \Dflydev\PlaceholderResolver\DataSource\ArrayDataSource($data) ;
	  
      $placeholderResolver = new \Dflydev\PlaceholderResolver\RegexPlaceholderResolver($dataSource, $prefix, $suffix);	  
	   
	  if(is_array($payload)){
		 $a = $payload;
		  $c = self::create($a);
		  $fn;		   
           foreach($c->flatten() as $k => $v){
			  if(is_string($v)){
				  $v = $placeholderResolver->resolvePlaceholder($v);
			  }
			  $c->set($k, $v);
		     }		  
		  return $c;		 
	  }elseif(is_string($payload)){
		  return $placeholderResolver->resolvePlaceholder($payload);
	  }else{
		  return $payload;
	  }
	 
  }
	
	
  public static function createContextFunctionAsString() : string {
      
    $ContextClass = self::class;  
      
      
      $evalMe = <<<PHPCODETOEVALOUTSIDE
      
 \$context = $ContextClass::create(compact(array_keys(get_defined_vars())));   
          
          
    foreach(array_keys(get_defined_vars()) as \$key){
        if(\$key !== 'this'){
           \$context->{\$key} = \${\$key};
        }
     }
          
      
PHPCODETOEVALOUTSIDE;
    return $evalMe;
  }
  
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/i.php" ; name="class frdl\i"
Content-Type: application/x-httpd-php

<?php 
declare(strict_types=1);

namespace frdl;


use Psr\Container\ContainerInterface;
use frdl\NotFoundException;


class i extends \UMA\DIC\Container implements ContainerInterface
{
	const DS = \DIRECTORY_SEPARATOR;
	
    protected static $instance = null;
    protected $factories;
	protected $container;
	
    public function __construct(array $entries = null){   
	   $this->factories = new \SplObjectStorage();
		$this->container = (null===$entries) ? [] : $entries;
    }
	
	public static function c(array $entries = null) :i{
	       if(null === self::$instance){
			   self::$instance = new self($entries);
		   }
		
	 return self::$instance;
	}
	
    public function set(string $id, $entry): void
    {
            $this->container[$id] = $entry;
    }	
	
    public function has($id){
        return \array_key_exists($id, $this->container);
    }	

    public function extend($id, $callable)
    {
        if (!$this->has($id)) {
            throw new NotFoundException($id);
        }
   

        $factory = $this->container[$id];
        $extended = function ($c) use ($callable, $factory) {
            return $callable($factory($c), $c);
        };
        if ($this->factories->contains($factory)) {
            $this->factories->detach($factory);
            $this->factories->attach($extended);
        }
        return $this->container[$id] = $extended;
    }

	
	
    public function raw($id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException($id);
        }
        if (isset($this->container[$id])) {
            return $this->container[$id];
        }
        return $this->container[$id];
    }
	
	
	
	public function factory($id, $callable=null){
        if(is_callable($id)){
		    $callable = $id;	
		}elseif(is_string($id)){
		    $this->set($id, $callable);	
		}
        $this->factories->attach($callable);
        return $callable;
    }
	
	
	
	
    public function get($id){
		
        if (!$this->has($id)) {
            throw new NotFoundException($id);
        }		

        if (!is_null($this->container[$id])
			&& (is_object($this->container[$id]) || is_callable($this->container[$id]) )
			&& $this->factories->contains($this->container[$id])
		   ) {
            return $this->container[$id]($this);
        }		
			
        if (!$this->resolved($id)) {
			   $this->container[$id] = \call_user_func($this->container[$id], $this);
        }
		
		
        return $this->container[$id];
    }
	

	
	  public function resolved(string $id): bool {
        if (!$this->has($id)) {
            throw new NotFoundException($id);
        }
      return !$this->container[$id] instanceof \Closure;
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/ServiceProvider.php" ; name="class frdl\ServiceProvider"
Content-Type: application/x-httpd-php

<?php 
 

namespace frdl;


abstract class ServiceProvider implements \Pimple\ServiceProviderInterface, \UMA\DIC\ServiceProvider
{
	
	abstract public function __invoke(\Psr\Container\ContainerInterface $c) : void;
	
	
	final public function register(\Pimple\Container $pimple) : void {
	     $this($pimple);
	}
    final public function provide(\UMA\DIC\Container $c) : void{
		  $this($c);
	}
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/ServiceLocator.php" ; name="class frdl\ServiceLocator"
Content-Type: application/x-httpd-php

<?php 
/*
 * This file is part of Pimple.
 *
 * Copyright (c) 2009 Fabien Potencier
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace frdl;



/**
 * Pimple PSR-11 service locator.
 *
 * @author Pascal Luna <skalpa@zetareticuli.org>
 */
class ServiceLocator implements \Psr\Container\ContainerInterface
{
    protected $container;
    protected $aliases = array();
    /**
     * @param PimpleContainer $container The Container instance used to locate services
     * @param array           $ids       Array of service ids that can be located. String keys can be used to define aliases
     */
    public function __construct(\Psr\Container\ContainerInterface $container, array $ids)
    {
        $this->container = $container;
        $this->alias($ids);
    }
	
	public function alias( array $ids){
        foreach ($ids as $key => $id) {
            $this->aliases[\is_int($key) ? $id : $key] = $id;
        }		
	}
	
    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        if (!isset($this->aliases[$id])) {
            throw new \Psr\Container\NotFoundExceptionInterface($id);
        }
       return $this->container[$this->aliases[$id]];  // $this->container->get($this->aliases[$id]);		
    }
    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        return isset($this->aliases[$id]) && $this->container->has($this->aliases[$id]);
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/ServiceIterator.php" ; name="class frdl\ServiceIterator"
Content-Type: application/x-httpd-php

<?php 
/*
 * This file is part of Pimple.
 *
 * Copyright (c) 2009 Fabien Potencier
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace frdl;
/**
 * Lazy service iterator.
 *
 * @author Pascal Luna <skalpa@zetareticuli.org>
 */
final class ServiceIterator implements \Iterator
{
    protected $container;
    protected $ids;
    public function __construct(\Psr\Container\ContainerInterface $container, array $ids)
    {
        $this->container = $container;
        $this->ids = $ids;
    }
    public function rewind()
    {
        \reset($this->ids);
    }
    public function current()
    {
        return $this->container[\current($this->ids)];
    }
    public function key()
    {
        return \current($this->ids);
    }
    public function next()
    {
        \next($this->ids);
    }
    public function valid()
    {
        return null !== \key($this->ids);
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Pimple/ServiceProviderInterface.php" ; name="class Pimple\ServiceProviderInterface"
Content-Type: application/x-httpd-php

<?php 

/*
 * This file is part of Pimple.
 *
 * Copyright (c) 2009 Fabien Potencier
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Pimple;

/**
 * Pimple service provider interface.
 *
 * @author  Fabien Potencier
 * @author  Dominik Zogg
 */
interface ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple);
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Flow/arrayIterator.php" ; name="class frdl\Flow\arrayIterator"
Content-Type: application/x-httpd-php

<?php 


namespace frdl\Flow;


class arrayIterator implements \Iterator {
  private $a;

  public function __construct( $theArray ) {
    $this->a = $theArray;
  }
  function rewind() {
    return reset($this->a);
  }
  function current() {
    return current($this->a);
  }
  function key() {
    return key($this->a);
  }
  function next() {
    return next($this->a);
  }
  function valid() {
    return key($this->a) !== null;
  }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Flow/LazyIterator.php" ; name="class frdl\Flow\LazyIterator"
Content-Type: application/x-httpd-php

<?php 


namespace frdl\Flow;
/**  LazyIterator
* from http://php.net/manual/de/language.generators.syntax.php
* CachedGenerator => LazyIerator
* (c)  info at boukeversteegh dot nl
* 
* 
* 
You can use generators to do lazy loading of lists. You only compute the items that are actually used. However, when you want to load more items, how to cache the ones already loaded?
Here is how to do cached lazy loading with a generator:
* 
* 
* 
* class Foobar {
    protected $loader = null;
    protected function loadItems() {
        foreach(range(0,10) as $i) {
            usleep(200000);
            yield $i;
        }
    }
    public function getItems() {
        $this->loader = $this->loader ?: new CachedGenerator($this->loadItems());
        return $this->loader->generator();
    }
}
$f = new Foobar;
# First
print "First\n";
foreach($f->getItems() as $i) {
    print $i . "\n";
    if( $i == 5 ) {
        break;
    }
}
# Second (items 1-5 are cached, 6-10 are loaded)
print "Second\n";
foreach($f->getItems() as $i) {
    print $i . "\n";
}
# Third (all items are cached and returned instantly)
print "Third\n";
foreach($f->getItems() as $i) {
    print $i . "\n";
}
*/
/*
function fibonacci($item) {
    $a = 0;
    $b = 1;
    for ($i = 0; $i < $item; $i++) {
        yield $a;
        $a = $b - $a;
        $b = $a + $b;
    }
}
$fibo = fibonacci(10);
$list= $fibo;
function loadItems($list) {
            foreach ($list as $value) {
               yield $value;
            }
}
$iterator = new LazyIterator(loadItems($list))->generator();
foreach($iterator as $i) {
    print $i . "\n";
    if( $i == 5 ) {
        break;
    }
}
foreach($iterator as $i) {
    print $i . "\n";
}
*/
class LazyIterator {
    protected $cache = [];
    protected $generator = null;
    public function __construct($generator) {
        $this->generator = $generator;
    }
    public function generator() {
        foreach($this->cache as $item) yield ($item);
        while( $this->generator->valid() ) {
            $this->cache[] = $current = $this->generator->current();
            $this->generator->next();
            yield ($current);
        }
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Flow/Element.php" ; name="class frdl\Flow\Element"
Content-Type: application/x-httpd-php

<?php  
/**
 * Copyright  (c) 2015, Till Wehowski
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. Neither the name of frdl/webfan nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY frdl/webfan ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL frdl/webfan BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 */
namespace frdl\Flow;
/**
*   
*   @provides the public methods:
*   ::create(mixed $context)
*   ->__invoke(mixed $context)            > apply $context and returns $this method chain
* 
*  ->Iterator($type = 'Array')           >not chainable returns Iterator
*  ->iterate(Array,callback,&result,&resultLog)
* 
*  ->on($event, $listener, $obj = null)
*  ->trigger($event, &$data = array() )
*  ->addEventListener                    >alias for on
*  ->dispatchEvent                       >alias for trigger
*  ->removeEventListener($event, $listener)
* 
*  ->context(mixed $context = undefined) >if getter not chainable returns context or $this
*  ->walk($Array)                        >IteratorGenerator 
* 
* Example 
* frdl\Flow\TestElement in __vendor__/frdl/Flow/Flow/TestElement.php
* <?php
* use frdl\Flow;
* 
* log('Starting testCase: '.__FILE__);
* function lnbr(){
* 	echo "\n";
* }
* function log($str){
*   echo microtime().':'.$str;
* *   lnbr();
*   ob_end_flush();	
* } 
* function highlight_num($file)
* {
*   $lines = implode(range(1, count(file($file))), '<br />');
*   $content = highlight_file($file, true);
* 
*  
*   $out = '
*     <style type="text/css">
*         .num {
*         float: left;
*         color: gray;
*         font-size: 13px;   
*         font-family: monospace;
*         text-align: right;
*         margin-right: 6pt;
*         padding-right: 6pt;
*         border-right: 1px solid gray;}
* 
*         body {margin: 0px; margin-left: 5px;}
*         td {vertical-align: top;}
*         code {white-space: nowrap;}
*     </style>';
*    
*    
*    
*     $out.= "<table><tr><td class=\"num\">\n$lines\n</td><td>\n$content\n</td></tr></table>";
*      
*     return $out;
* } 
*  
* log('Creating inherited Element class and Testclasses'.lnbr().'Bind Events on Testclasses listeners'.lnbr().'Bind a TestDebugger to the testEvent and trigegr it');
* class TestElement extends Element{
*   protected $reflection;
*   	protected $initTime=null;
* 	public function __construct(){
* 	    parent::create( func_get_args());
* 		$this->refelection = ReflectionClass::export('Apple', true);
* 	}
* 	function __destuct(){
*          register_shutdown_function(function ($className) {
* 		log('shutdown_function.invocation by destructor of '.$className);              
*          }, get_class($this));		
* 	} 
*    
*    public function test($event, &$target, &$eventData){
*    	  log('Triggering listener of "'.$event.'" Event in listener '.__METHOD__);
*    	  log(
*    	     '<pre>'
*    	     .'Eventdata: '.lnbr()
*    	     .print_r($eventData,true)
*    	     .lnbr()
*    	     .__CLASS__.':'
*    	     .lnbr()
*    	     .$this->refelection.lnbr()
*    	     .'</pre>'.lnbr()
*    	     .highlight_num(__FILE__).lnbr()
*    	  );
*    }
* }
* class MyElementSubClass extends Element{
* 	protected function __construct(){
* 		$args = func_get_args();
* 		parent::__construct($args);
* 		$this->name=$args[0];
* 		$this->data=$args[1];
* 		log('Creating Instance of '.__CLASS__.' inherrited from '.get_class(parent) );
* 	}
* 	public static function create($name, $data){
* 	   return parent::create($name, $data);
* 	}	
* }
* 
* function myEventListenerGlobalFunction($event, &$target, &$data) {
* 	// return false;  // cancel/ stopPropagation 
*   log("Hello from triggered function myEventListenerGlobalFunction() on the $event Event");
* }
* 
* class Foo {
*   public function hello($event, &$target, &$eventData) {
*     log("Hello from triggered ".__CLASS__."($event, ".print_r($target,true).", ".print_r($eventData,true).")");
*   }
* }
* 
* class Bar {
*    public static function listen() {
*     log("Hello from Bar::hello()");
*   }
* }
*  $foo = new Foo();
*  $Context = new \stdclass;
*  
*  $myElement = MyElementSubClass::create($Context)
*   // bind a global function to the 'test' event
*   ->on("test", "myEventListenerGlobalFunction")   
* 
*   // bind an anonymous function
*   ->on("test", function($event, &$target, &$eventData) { 
*      log("Hello from anonymous function triggered by Event:".$event);
*   })  
* 
* 
*    ->on("test", "hello", $foo)  // bind an class function on an instance
* 
* 
*   ->on("test", "Bar::listen")  // bind a static class function
* 
* 
* 
*  ;
* $testData=array(
*   'data' => array('someTestData', 1, 2, 3, 5, 8, 13, 21, new \stdclass),
*   'Author' => '(c) Till Wehowski, http://frdl.webfan.de',
*   '__FILE__' => __FILE__,
* );
* $myElement()
*    ->on("test", "test", new TestElement)  
*     
*   // dispatch the "test event"  
*    ->trigger("test", $testData)
*     
*    ;
*/
abstract class Element {
	protected static $tagName;
	protected $name; //id/selector
	protected $_context = null;
	
    protected $events = array();
	function __construct(){
		$this->_context=func_get_args();
		self::$tagName = get_class($this);
	}
	public static function create(){
	   $_call='\\'.get_class(self).'::__construct';	
	   return call_user_func_array($_call, func_get_args());
	}	
	function __destruct(){
		
	}
    final public function __invoke(/* mixed */)
    {
        $this->_context=func_get_args();
		return $this;
    }	
    
    final public function context(){
       $args=func_get_args();
      if(0===count($args)){
	     return  $this->_context;		
	  } 	
	  return $this($args);
	}
	
  /*
    Iterator "Trait"
  */	
   public function Iterator($type = 'Array', $Traversable){
   	 if('Array'===$type) 
   	     return $this->_ArraIterator($Traversable);
   	  
   	  
      return function($Traversable){
            return $Traversable;
      };   	  
   }
   
   public function iterate(Array $Collection, $callback/* 
           function($item) use(&$result){
		   	  // ... process item
		   	  return $result;
		   }   
   */, &$result=null, &$resultLog=null){
   	$resultLog=array();
     foreach($this->Iterator('Array', $Collection) as $item) {
        $resultLog[] = call_user_func_array($callback, array($item)) ;
     }
     return $this;	
   }
 
	
	
	
  /*
    Event "Trait"
  */	
  public function removeEventListener($event, $listener){
     if (!isset($this->events[$event])) return $this;
    
    $indexOf = 0;
    foreach ($this->Iterator('Array', $this->events[$event]) as $EventListener) {
      // if($EventListener === $listener)	{
	   if(spl_object_id((object)$EventListener) === spl_object_id((object)$listener))	{
         array_splice($this->events[$event], $indexOf, 1);
         $indexOf--;
		 
	   }
         $indexOf++;
    }
    return $this; 	
  }
  public function removeListener(){
  	return call_user_func_array(array($this,'removeEventListener'), func_get_args());
  }  
  
   
  public function off(){
  	return call_user_func_array(array($this,'removeEventListener'), func_get_args());
  }  
   
   
   
   
  public function addEventListener(){
  	return call_user_func_array(array($this,'on'), func_get_args());
  }
    
  public function on($event, $callback, $obj = null) {
    if (!isset($this->events[$event])) {
      $this->events[$event] = array();
    }
   
    $this->events[$event][] = ($obj === null)  ? $callback : array($obj, $callback);
    return $this;
  }
  
  
  
   public function once($event, $callback, $obj = null) {
	    
   	  $THAT =$this; 
   	  $obj = $obj;
   	  $callback= $callback;
      $listener = (function() use($event, &$callback, &$THAT, &$obj, &$listener){
   	    	$THAT->removeEventListener($event, $listener);
   	  	     call_user_func_array(($obj === null)  ? $callback : array($obj, $callback), func_get_args());
   	  });
   	  $this->on($event, $listener);
   	  
    return $this;
  }
  
  /*
		EventEmitter.prototype.once = function (event, listener)
		{
			this.on(event, function g ()
				{
					this.removeListener(event, g);
					listener.apply(this, arguments);
				});
			return this;
		};  
  */
  
  public function emit(){
  	return call_user_func_array(array($this,'trigger'), func_get_args());
  }  
  public function dispatchEvent(){
  	return call_user_func_array(array($this,'trigger'), func_get_args());
  }
  public function trigger($event, $data = array()) {
    if (!$this->events[$event]) return $this;
   
  
    $indexOf=0;
    foreach ($this->Iterator('Array', $this->events[$event]) as $callback) {
      	$payload = array();
      	$ev = &$event;
      	$target = &$this;
      	$evData = &$data;
   	    array_push($payload, $event);
   	    array_push($payload, $target);  
     	array_push($payload, $data);   
     	if(!is_callable($callback)){
			trigger_error('Cannot trigger Event '.$event.' on Listener #'.$indexOf, E_USER_WARNING);
			continue;
		} 	
	//  if(frdl\run($callback, $payload) === false) break;
	  if(false === call_user_func_array($callback, $payload))break;
      $indexOf++;
    }
    return $this;
 }	
  	
  	
 	
 	
 	
 	
/*
private...
*/
   public function walk($list){
      foreach ($list as $value) {
         yield ($value);
      }  	
   }
 	
   public function _ArraIterator($arr){
     if(true===version_compare(PHP_VERSION, '5.5', '>=')) {
       $iterator=new LazyIterator($this->walk($arr));  
       return $iterator->generator();  
     }else{
     	/*
         return function(Array $arr){
            return $arr;
         };
         */
         return new arrayIterator($arr); 	
       }		
  }
 	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Flow/EventEmitter.php" ; name="class frdl\Flow\EventEmitter"
Content-Type: application/x-httpd-php

<?php  
/**
 * 
 * Copyright  (c) 2017, Till Wehowski
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. All advertising materials mentioning features or use of this software
 *    must display the following acknowledgement:
 *    This product includes software developed by the frdl/webfan.
 * 4. Neither the name of frdl/webfan nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY frdl/webfan ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL frdl/webfan BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 */
 /**
 * EventEmitter javascript like event based final state object : 
 *    https://github.com/frdl/-Flow/blob/master/api-d/4/js-api/library.js/core/plugin.core.js#L4501
 */
namespace frdl\Flow;



class EventEmitter extends Element{
	
	
	public function hasListeners($event){
	   return (isset($this->events[$event]) && 0 < count($this->events[$event])) ? true : false;
	}


	public function required($eventsArrayIn, $callback, $multiple = false){
				$that = &$this;
							
				$eventArray = $eventsArrayIn;
									  	$eventData  = array();
									  	$updateData = array();
									  	$called = false;
									  	$listen = function (&$obj, $multiple){
									  		if(true===$multiple)
									  		{
									  		 //	return $events->on || $events->addListener;
									  		   return array($obj, 'on');
									  		}
									  		else
									  		{
										  	   return array($obj, 'once');
									  		}
									  	};
									  	$listen = $listen($that, $multiple);
									  	$silence= array($that, 'off');
									  	$isOn   = $listen === array($that, 'on');
									  	$clear  = function () use ( &$eventArray, &$updateData, $silence, &$that){
									  		
									  	//	foreach($eventArray as $event){
									  		foreach($that->Iterator('Array', $eventArray) as $event){
												call_user_func_array($silence, array($event, $updateData[array_search($event, $eventArray)]));
											}
									  		$eventData = array();
									  	}
									  	;
									  	
	
									  	$stateCheck = function () use ( &$eventArray, &$eventData, &$called, &$multiple, &$isOn, $clear, &$that, &$callback)
									  	{
									  		
									  		$waiting = false;
									  		$ready = false;
									  		foreach($that->Iterator('Array', $eventArray) as $event){
									  			  $k = array_search($event, $eventArray);
									  		//	  if(false===$k || null===$eventData[$k]){
												if(false===$k || !isset($eventData[$k])){
												  	 $waiting = true;
												  	 break;
												  }

											}									  		 
									  		
									  		
									  		$ready = (false === $waiting) ? true : false;
									  		if(true===$ready && true!==$called)
									  		{
									  			call_user_func_array($callback, array($eventData));
									  			if(true!==$multiple)
									  			{
									  				$called = true;
									  				if(true===$isOn)
									  				{
									  					$clear();
									  				}
									  			}
									  		}
									  	}
									  	;								  	
									  	
									
		                                                   
		$updateState = function ($eventName) use ( &$eventArray, &$eventData, &$stateCheck){
									  		$index = array_search($eventName, $eventArray);
									  		return function ($data = null) use ( &$eventData, &$index, &$stateCheck){
									  			if(null===$data)
									  			{
									  			   $data = true;
									  			}
									  			$eventData[$index] = $data;
									  			call_user_func_array($stateCheck, array());
									  		 //   $stateCheck();
									  		}
									  		;
									  	}
									  	;
									
									
									  	$stateReady = function ($s) use ( &$eventData, &$eventArray)
									  	{
									  		 $k = array_search($s, $eventArray);
									  		 return (false===$k || !isset($eventData[$k])) ? false : true;
									  	}
									  	;
									  	
									  	
									  	$stateGet =	function ($s) use ( &$eventData, &$eventArray)
									  	{
									  		return $eventData[array_search($s, $eventArray)];
									  	}
									  	;
									  	
									  	
									  	
									  	
									  										 
		                                     
		$addState =	function () use ( &$eventArray, &$updateData, $updateState, $listen, &$that)
									  	{
									  		$events = func_get_args();
									  		
									  		foreach($that->Iterator('Array', $events) as $event){
                                              
												if(is_array($event)){                                                	
												
												  foreach($event as $ev){													
												
												  	$index = array_search($ev, $eventArray);
									  				if($index === false)
									  				{
									  					array_push($eventArray, $ev);
									  					$index = count($eventArray) - 1;
									  				}
									  				$updateData[$index] = $updateState($ev);

									  				 call_user_func_array($listen, array($ev,$updateData[$index])); 													
													
												   }
												}else{
													$index = array_search($event, $eventArray);
									  				if($index === false)
									  				{
									  					array_push($eventArray, $event);
									  					$index = count($eventArray) - 1;
									  				}
									  				$updateData[$index] = $updateState($event);

									  				call_user_func_array($listen, array($event,$updateData[$index])); 
												}

											}											  		
									  	};
									  	
									  	
			foreach($that->Iterator('Array', $eventArray) as $event){                
				$addState($event);
			}										  	


       /* $finStateObj = new \O; */
      // $fo = new \O;
       $fo = new \stdclass;		
       $fo->cancel = $clear;
       $fo->add = $addState;
       $fo->addState = $addState;
       $fo->events = $eventArray;
       $fo->status = $eventData;
       $fo->stateReady = $stateReady;
       $fo->stateGet = $stateGet;
       
        
				
	   return $fo;
	}
									  
	

} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Templater/ReplacerInterface.php" ; name="class frdl\Templater\ReplacerInterface"
Content-Type: application/x-httpd-php

<?php 

namespace frdl\Templater;

use frdl\Context as Context;


interface ReplacerInterface
{
	public function replace(Context $context, string $template) : string;		
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Templater/Replacer.php" ; name="class frdl\Templater\Replacer"
Content-Type: application/x-httpd-php

<?php 

namespace frdl\Templater;

use frdl\Context as Context;

abstract class Replacer implements ReplacerInterface
{
	
    final public static function __callStatic($name, $arguments){
		return call_user_func_array([new self, $name], $arguments);
	}
	
	abstract public function replace(Context $context, string $template) : string;
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Templater/SimpleDotNotationReplacer.php" ; name="class frdl\Templater\SimpleDotNotationReplacer"
Content-Type: application/x-httpd-php

<?php 

namespace frdl\Templater;

use frdl\Context as Context;

class SimpleDotNotationReplacer extends Replacer
{
	
    public function replace(Context $context, string $template) : string {
		return preg_replace_callback('/\{\{([\w\.^\{\}]+)\}\}/is', function($m) use ($context){
                if($context->has($m[1])){                	
					   return $context->get($m[1]);	
				}else{
                       return $m[0]; 
               }
          }, $template);			
	}
	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Templater/AdvancedReplacer.php" ; name="class frdl\Templater\AdvancedReplacer"
Content-Type: application/x-httpd-php

<?php 

namespace frdl\Templater;

use frdl\Context as Context;

class AdvancedReplacer extends Replacer
{
	
	protected $filters;
	protected $templating;
	
	public function __construct(){
	   $this->filters = [
	      'uppercase' => 'strtoupper',
	      'lowercase' => 'strtolower',
	      'ucfirst' => 'ucfirst',
	      'json' => 'json_encode',
	      'json_encode' => 'json_encode',
		   
	   ];	
		
		$this->templating = new Templating();
	}
		
	public function getTemplating(){
		return $this->templating;
	}
	
	public function getFilters(){
		return $this->filters;
	}
		
	public function setFilter($name, $filter){
		$this->filters[$name]=$filter;	
		return $this;
	}		
	public function setFilters(array $filters){
		$this->filters = $filters;		
		return $this;
	}
	
    public function replace(Context $context, string $template) : string {
		$self = new self;
		return $context(function($ArrayObject) use($self, $template){
		     return $self->getTemplating()->render( $template, $ArrayObject->all(), $self->getFilters() );					
		});

	}
	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Templater/Component.php" ; name="class frdl\Templater\Component"
Content-Type: application/x-httpd-php

<?php 
/*
* https://github.com/wmde/php-vuejs-templating/blob/master/src/Component.php
*/
namespace frdl\Templater;
use DOMAttr;
use DOMCharacterData;
use DOMDocument;
use DOMElement;
use DOMNode;
use DOMNodeList;
use DOMText;
use Exception;
use LibXMLError;
use WMDE\VueJsTemplating\FilterExpressionParsing\FilterParser;
use WMDE\VueJsTemplating\JsParsing\BasicJsExpressionParser;
use WMDE\VueJsTemplating\JsParsing\CachingExpressionParser;
use WMDE\VueJsTemplating\JsParsing\JsExpressionParser;
class Component extends \WMDE\VueJsTemplating\Component
{
	
	
	/**
	 * @param DOMNode $node
	 * @param array $data
	 */
	private function handleNode( DOMNode $node, array $data ) {
		$this->replaceMustacheVariables( $node, $data );
		if ( !$this->isTextNode( $node ) ) {
			$this->stripEventHandlers( $node );
		        $this->handleNgRepeat( $node, $data );
			$this->handleFor( $node, $data );
			$this->handleRawHtml( $node, $data );
			$this->handleNgBindHtml( $node, $data );
			$this->handleNgBind( $node, $data );
			if ( !$this->isRemovedFromTheDom( $node ) ) {
				$this->handleAttributeBinding( $node, $data );
				$this->handleNgIf( $node->childNodes, $data );
				$this->handleNgShow( $node->childNodes, $data );
				$this->handleIf( $node->childNodes, $data );
				foreach ( iterator_to_array( $node->childNodes ) as $childNode ) {
					$this->handleNode( $childNode, $data );
				}
			}
		}
	}
	
	private function handleNgBindHtml( DOMNode $node, array $data ) {
		if ( $this->isTextNode( $node ) ) {
			return;
		}
		/** @var DOMElement $node */
		if ( $node->hasAttribute( 'ng-bind-html' ) ) {
			$variableName = $node->getAttribute( 'ng-bind-html' );
			$node->removeAttribute( 'ng-bind-html' );
			$newNode = $node->cloneNode( true );
			$this->appendHTML( $newNode, $data[$variableName] );
			$node->parentNode->replaceChild( $newNode, $node );
		}
	}
	
	private function handleNgBind( DOMNode $node, array $data ) {
		if ( $this->isTextNode( $node ) ) {
			return;
		}
		/** @var DOMElement $node */
		if ( $node->hasAttribute( 'ng-bind' ) ) {
			$variableName = $node->getAttribute( 'ng-bind' );
			$node->removeAttribute( 'ng-bind' );
			$newNode = $node->cloneNode( true );
			$this->appendHTML( $newNode, strip_tags($data[$variableName]) );
			$node->parentNode->replaceChild( $newNode, $node );
		}
	}	
	
	
	private function handleNgIf( DOMNodeList $nodes, array $data ) {
		// Iteration of iterator breaks if we try to remove items while iterating, so defer node
		// removing until finished iterating.
		$nodesToRemove = [];
		foreach ( $nodes as $node ) {
			if ( $this->isTextNode( $node ) ) {
				continue;
			}
			/** @var DOMElement $node */
			if ( $node->hasAttribute( 'ng-if' ) ) {
				$conditionString = $node->getAttribute( 'ng-if' );
				$node->removeAttribute( 'ng-if' );
				$condition = $this->evaluateExpression( $conditionString, $data );
				if ( !$condition ) {
					$nodesToRemove[] = $node;
				}
				$previousIfCondition = $condition;
			} 
		}
		foreach ( $nodesToRemove as $node ) {
			$this->removeNode( $node );
		}
	}	
	
	private function handleNgRepeat( DOMNode $node, array $data ) {
		if ( $this->isTextNode( $node ) ) {
			return;
		}
		/** @var DOMElement $node */
		if ( $node->hasAttribute( 'ng-repeat' ) ) {
			list( $itemName, $listName ) = explode( ' in ', $node->getAttribute( 'ng-repeat' ) );
			$node->removeAttribute( 'ng-repeat' );
			foreach ( $data[$listName] as $item ) {
				$newNode = $node->cloneNode( true );
				$node->parentNode->insertBefore( $newNode, $node );
				$this->handleNode( $newNode, array_merge( $data, [ $itemName => $item ] ) );
			}
			$this->removeNode( $node );
		}
	}
	
	private function handleNgShow( DOMNodeList $nodes, array $data ) {
		// Iteration of iterator breaks if we try to remove items while iterating, so defer node
		// removing until finished iterating.
		$nodesToRemove = [];
		foreach ( $nodes as $node ) {
			if ( $this->isTextNode( $node ) ) {
				continue;
			}
			/** @var DOMElement $node */
			if ( $node->hasAttribute( 'ng-show' ) ) {
				$conditionString = $node->getAttribute( 'ng-show' );
				$node->removeAttribute( 'ng-show' );
				$condition = $this->evaluateExpression( $conditionString, $data );
				if ( !$condition ) {
					$nodesToRemove[] = $node;
				}
				$previousIfCondition = $condition;
			} 
		}
		foreach ( $nodesToRemove as $node ) {
			$this->removeNode( $node );
		}
	}		
	
	
	/**
	 * @param DOMNodeList $nodes
	 * @param array $data
	 */
	private function handleIf( DOMNodeList $nodes, array $data ) {
		// Iteration of iterator breaks if we try to remove items while iterating, so defer node
		// removing until finished iterating.
		$nodesToRemove = [];
		foreach ( $nodes as $node ) {
			if ( $this->isTextNode( $node ) ) {
				continue;
			}
			/** @var DOMElement $node */
			if ( $node->hasAttribute( 'v-if' ) ) {
				$conditionString = $node->getAttribute( 'v-if' );
				$node->removeAttribute( 'v-if' );
				$condition = $this->evaluateExpression( $conditionString, $data );
				if ( !$condition ) {
					$nodesToRemove[] = $node;
				}
				$previousIfCondition = $condition;
			} elseif ( $node->hasAttribute( 'v-else' ) ) {
				$node->removeAttribute( 'v-else' );
				if ( $previousIfCondition ) {
					$nodesToRemove[] = $node;
				}
			}
		}
		foreach ( $nodesToRemove as $node ) {
			$this->removeNode( $node );
		}
	}
	private function handleFor( DOMNode $node, array $data ) {
		if ( $this->isTextNode( $node ) ) {
			return;
		}
		/** @var DOMElement $node */
		if ( $node->hasAttribute( 'v-for' ) ) {
			list( $itemName, $listName ) = explode( ' in ', $node->getAttribute( 'v-for' ) );
			$node->removeAttribute( 'v-for' );
			foreach ( $data[$listName] as $item ) {
				$newNode = $node->cloneNode( true );
				$node->parentNode->insertBefore( $newNode, $node );
				$this->handleNode( $newNode, array_merge( $data, [ $itemName => $item ] ) );
			}
			$this->removeNode( $node );
		}
	}
	private function stripEventHandlers( DOMNode $node ) {
		if ( $this->isTextNode( $node ) ) {
			return;
		}
		/** @var DOMAttr $attribute */
		foreach ( $node->attributes as $attribute ) {
			if ( strpos( $attribute->name, 'v-on:' ) === 0 ) {
				$node->removeAttribute( $attribute->name );
			}
		}
	}
		private function appendHTML( DOMNode $parent, $source ) {
		$tmpDoc = $this->parseHtml( $source );
		foreach ( $tmpDoc->getElementsByTagName( 'body' )->item( 0 )->childNodes as $node ) {
			$node = $parent->ownerDocument->importNode( $node, true );
			$parent->appendChild( $node );
		}
	}
	private function handleRawHtml( DOMNode $node, array $data ) {
		if ( $this->isTextNode( $node ) ) {
			return;
		}
		/** @var DOMElement $node */
		if ( $node->hasAttribute( 'v-html' ) ) {
			$variableName = $node->getAttribute( 'v-html' );
			$node->removeAttribute( 'v-html' );
			$newNode = $node->cloneNode( true );
			$this->appendHTML( $newNode, $data[$variableName] );
			$node->parentNode->replaceChild( $newNode, $node );
		}
	}
/**
	 * @param string $expression
	 * @param array $data
	 *
	 * @return bool
	 */
	private function evaluateExpression( $expression, array $data ) {
		return $this->expressionParser->parse( $expression )->evaluate( $data );
	}
	private function removeNode( DOMElement $node ) {
		$node->parentNode->removeChild( $node );
	}
	/**
	 * @param DOMNode $node
	 *
	 * @return bool
	 */
	private function isTextNode( DOMNode $node ) {
		return $node instanceof DOMCharacterData;
	}
	private function isRemovedFromTheDom( DOMNode $node ) {
		return $node->parentNode === null;
	}
/**
	 * @param string $template HTML
	 * @param callable[] $filters
	 */
	public function __construct( $template, array $filters ) {
		$this->template = $template;
		$this->filters = $filters;
		$this->expressionParser = new CachingExpressionParser( new BasicJsExpressionParser() );
		$this->filterParser = new FilterParser();
	}
/**
	 * @param DOMNode $node
	 * @param array $data
	 */
	private function replaceMustacheVariables( DOMNode $node, array $data ) {
		if ( $node instanceof DOMText ) {
			$text = $node->wholeText;
			$regex = '/\{\{(?P<expression>.*?)\}\}/x';
			preg_match_all( $regex, $text, $matches );
			foreach ( $matches['expression'] as $index => $expression ) {
				$value = $this->filterParser->parse( $expression )
					->toExpression( $this->expressionParser, $this->filters )
					->evaluate( $data );
				$text = str_replace( $matches[0][$index], $value, $text );
			}
			if ( $text !== $node->wholeText ) {
				$newNode = $node->ownerDocument->createTextNode( $text );
				$node->parentNode->replaceChild( $newNode, $node );
			}
		}
	}
	
	private function handleAttributeBinding( DOMElement $node, array $data ) {
		/** @var DOMAttr $attribute */
		foreach ( iterator_to_array( $node->attributes ) as $attribute ) {
			if ( !preg_match( '/^:[\w-]+$/', $attribute->name ) ) {
				continue;
			}
			$value = $this->filterParser->parse( $attribute->value )
				->toExpression( $this->expressionParser, $this->filters )
				->evaluate( $data );
			$name = substr( $attribute->name, 1 );
			if ( is_bool( $value ) ) {
				if ( $value ) {
					$node->setAttribute( $name, $name );
				}
			} else {
				$node->setAttribute( $name, $value );
			}
			$node->removeAttribute( $attribute->name );
		}
	}
/**
	 * @param DOMDocument $document
	 *
	 * @return DOMElement
	 * @throws Exception
	 */
	private function getRootNode( DOMDocument $document ) {
		$rootNodes = $document->documentElement->childNodes->item( 0 )->childNodes;
		if ( $rootNodes->length > 1 ) {
			throw new Exception( 'Template should have only one root node' );
		}
		return $rootNodes->item( 0 );
	}
/**
	 * @param string $html HTML
	 *
	 * @return DOMDocument
	 */
	private function parseHtml( $html ) {
		$entityLoaderDisabled = libxml_disable_entity_loader( true );
		$internalErrors = libxml_use_internal_errors( true );
		$document = new DOMDocument( '1.0', 'UTF-8' );
		// Ensure $html is treated as UTF-8, see https://stackoverflow.com/a/8218649
		if ( !$document->loadHTML( '<?xml encoding="utf-8" ?>' . $html ) ) {
			//TODO Test failure
		}
		/** @var LibXMLError[] $errors */
		$errors = libxml_get_errors();
		libxml_clear_errors();
		// Restore previous state
		libxml_use_internal_errors( $internalErrors );
		libxml_disable_entity_loader( $entityLoaderDisabled );
		foreach ( $errors as $error ) {
			//TODO html5 tags can fail parsing
			//TODO Throw an exception
		}
		return $document;
	}
	/**
	 * @param array $data
	 *
	 * @return string HTML
	 */
	public function render( array $data ) {
		$document = $this->parseHtml( $this->template );
		$rootNode = $this->getRootNode( $document );
		$this->handleNode( $rootNode, $data );
		return $document->saveHTML( $rootNode );
	}
	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/Templater/Templating.php" ; name="class frdl\Templater\Templating"
Content-Type: application/x-httpd-php

<?php 

namespace frdl\Templater;

class Templating {
	/**
	 * @param string $template
	 * @param array $data
	 * @param callable[] $filters
	 *
	 * @return string
	 */
	public function render( $template, array $data, array $filters = [] ) {
		$component = new Component( $template, $filters );
		return $component->render( $data );
	}
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Psr/Container/ContainerInterface.php" ; name="class Psr\Container\ContainerInterface"
Content-Type: application/x-httpd-php

<?php 
/**
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace Psr\Container;

/**
 * Describes the interface of a container that exposes methods to read its entries.
 */
interface ContainerInterface
{
    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id);

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id);
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/UMA/DIC/ServiceProvider.php" ; name="class UMA\DIC\ServiceProvider"
Content-Type: application/x-httpd-php

<?php 

declare(strict_types=1);

namespace UMA\DIC;

interface ServiceProvider
{
    public function provide(Container $c): void;
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/UMA/DIC/Container.php" ; name="class UMA\DIC\Container"
Content-Type: application/x-httpd-php

<?php 

//declare(strict_types=1);

namespace UMA\DIC;

//use Psr\Container\ContainerInterface;
//use Psr\Container\NotFoundExceptionInterface;

class Container implements \Psr\Container\ContainerInterface
{
    /**
     * @var array
     */
    private $container;

    /**
     * @param array $entries Array of string => mixed.
     */
    public function __construct(array $entries = [])
    {
        $this->container = $entries;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new class extends \LogicException implements \Psr\Container\NotFoundExceptionInterface {};
        }

        if ($this->container[$id] instanceof \Closure) {
            $this->container[$id] = \call_user_func($this->container[$id], $this);
        }

        return $this->container[$id];
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        return \array_key_exists($id, $this->container);
    }

    /**
     * @param string $id
     * @param mixed  $entry
     */
    public function set(string $id, $entry)
    {
        $this->container[$id] = $entry;
    }

    public function register(\UMA\DIC\ServiceProvider $provider)
    {
        $provider->provide($this);
    }

    /**
     * Returns whether a given service has already been resolved
     * into its final value, or is still a callable.
     *
     * @throws NotFoundExceptionInterface No entry was found for **this** identifier.
     */
    public function resolved(string $id)
    {
        if (!$this->has($id)) {
            throw new class extends \LogicException implements \Psr\Container\NotFoundExceptionInterface {};
        }

        return !$this->container[$id] instanceof \Closure;
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Webfan/App/Shield.php" ; name="class Webfan\App\Shield"
Content-Type: application/x-httpd-php

<?php  

namespace Webfan\App;

use Webfan\App\TerminalEmulator;

final class Shield implements \Finite\StatefulInterface, \Serializable
{
/*
		$bashFileBasename = '.bashrc_profile';
		//$bashFileBasename = '.bashrc-frdl';
		*/
	const SESSIONKEY = 'apc';
	const CONFIG_FILENAME = 'frdl.stub.config.php';
	const WORKSPACES_FILENAME = 'frdl.workspaces.php';
	const VERSION_FILENAME = 'frdl.version.config.php';
	const BASH_FILENAME = '.bashrc_profile';
	//const BASH_FILENAME = '.bashrc-frdl';
	const PROJECT_FILENAME = 'frdl.project.json';
	const DEPLOYMENT_FILENAME = 'frdl.deployment.json';
	const STAGES_FILENAME = 'frdl.stages.json';
	const CONFIG_PROJECT_FILENAME = 'frdl.project.config.php';
	
	const SESSION_NAME = 'FRDLADMINSESSID';
	
	const BLUE = 0;
	const GREEN = 1;
	
	protected $uri;
    protected $updateStatus;
    protected $appStatus;
    protected $userStatus;
    protected $setupStatus;
    protected $jobStatus;
	protected $state;
	protected $installStatus;
	protected $container = null;
	protected $stub = null;
	//protected $config = [];
	protected $config;
	protected $v = null;
	protected $latest;
	protected $version = null;
	protected $_pci = 0;
	protected static $loginAttempts = 0;
	
	protected static $instance = null;
	
	protected $_emitter = null;

	protected $__configLoaded = false;
	public static $enableLoginPost = false;
	protected static $created_sessions = [];
	
	
   public function __construct(\Psr\Container\ContainerInterface $container = null, $stub = null, $initialize = false, $enableLoginPost = false){	
	   
	   //ob_start();
	  // ini_set('display_errors','on');
       //error_reporting(\E_ALL);
	   
	   $isFirst = null === self::$instance;
	   
	   
	   if(is_bool($enableLoginPost)){
		   self::$enableLoginPost = $enableLoginPost;
	   }
	   $this->setStub($stub);
	   $this->state = null; 	 
	   

	          $this->setContainer((null===$container) ? \frdl\i::c() : $container);
	   	         

	   if(true===$initialize){		   
		   
	           $Event = new \webfan\hps\Event('initialize:before');	   
			   $Event->setArgument('Shield', $this);	   
			   $Event->setArgumentReference('container', $this->container);  	   
			   $this->getEmitter()->emit($Event->getName(), $Event);   
	   		   
		   
		    call_user_func_array([$this, 'initialize'], []);  
	   }
	   
   }
	
	public function __destruct(){
	  	//  if($this->session_started()){
		 //   $_SESSION[TerminalEmulator::SESSIONKEY]['cwd'] = getcwd();
		//  }	
	}
	
    public static function getInstance($stub = null, \Psr\Container\ContainerInterface $container = null, $enableLoginPost = false){
	   if(null === self::$instance){		 
		  self::$instance = new self((null===$container) ? \frdl\i::c() : $container, $stub, false, $enableLoginPost); 		    
	  }
	  
	  return self::$instance;
  }
	
	
	
   public function getVersion($full = true){
	   $this->getV();
	   if(true===$full){
		 return $this->version;   
	   }else{
	      return $this->version['version'];
	   }
   }
	
	public function getCacheBustKey(){
	 return sha1( date('Y').date('W').'.'.max(filemtime($this->getStub()->location), 1).$this->getVersion(false).$this->getStub()->location);	
	}
	
	public function terminate(){		

		
	if( 'cli'!==strtolower(\PHP_SAPI) && 'web-cli'!==strtolower(\PHP_SAPI)  ){
	
	 ignore_user_abort(true);  
			

	   if(session_status() === \PHP_SESSION_ACTIVE)session_write_close();

 		
	
 while(($ob_status = ob_get_status(false)) 
	   && $ob_status && is_array($ob_status) && 0 < count($ob_status)
	   && isset($ob_status[0]) 
	   && isset($ob_status[0]['status'])
	   && $ob_status[0]['status'] !== \PHP_OUTPUT_HANDLER_END
	   && ob_get_level()){
    ob_end_flush();
 }
	
	 // if (version_compare(PHP_VERSION, '7.1.15') >= 0) {
	 //       die('hi');	 
	 // }
	
/*
  
	try{
	  if(function_exists('fastcgi_finish_request'))fastcgi_finish_request();	
	}catch(\Exception $e){
	  error_log($e->getMessage());	
	}
	*/
   }
  }
	
	
	
   public function __get($name){
	   if('config' === $name){
		    $this->config = (true ===$this->__configLoaded && is_object($this->config) && $this->config instanceof \webfan\hps\patch\ngScope) ? $this->config :  $this->loadConfig()->config;
		  return $this->config;   
	   }elseif('updateAvailable' === $name){
		  return !version_compare($this->getVersion(false), $this->v->latest, '>=');   
	   }elseif('emitter' === $name){
		  return $this->getEmitter();  
	   }
	   
	   
	   if(null!==$this->container && $this->getContainer()->has($name)){
		  return $this->container->get($name);
	   }
	   
	   if(property_exists($this, $name)){
		   return $this->{$name};
	   }
	   
	   throw new \Exception('Undefined property `'.$name.'` of '.__CLASS__);
   }
	
	
  public function getEmitter(){
		   if(null === $this->_emitter){
		       $this->_emitter =  $this->getContainer()->get('emitter');
		 
			   $emitter = $this->_emitter;
			   $container = $this->container;
	   
          $this->_emitter->required(['loaded:version', 'Shield.initialized', 'initialize:before', 'loaded:config', 'loaded:config:caches'], function($states) use(&$emitter, &$container){	

				   $Event = new \webfan\hps\Event('ready:for:checkForAutoSelfUpdate');		
				   $Event->setArgument('event-states', $states);		
				   $Event->setArgumentReference('container', $container);		
				   $emitter->emit($Event->getName(), $Event); 	 
			  
		  }, false);	  
			   
			   
	  
	  		   $this->registerEvents(); 	 	   
		   }
	 return $this->_emitter;  	 
  }
	
	
	
	
  public function getFinalStateMachine(){
	return $this->getContainer()->get('webfan.app.fsm');  
  }
	
  public function getFsm(){
	return $this->getFinalStateMachine();  
  }
	
  public function getContainer(){
	  if(!$this->container->has('emitter')){
	     $this->container->register(new ShieldServiceProvider($this));
	  }	  
	  
	  return $this->container;
  }

  protected function setContainer(\Psr\Container\ContainerInterface $container){
	  $this->container=$container;
	  return $this;
  }			
	
	
  public function getConfig(){
	  
	  $this->config = (true ===$this->__configLoaded && is_object($this->config) && $this->config instanceof \webfan\hps\patch\ngScope) ? $this->config :  $this->loadConfig()->config;
	  
	  $this->config['baseUrlInstaller'] = (isset($this->config['baseUrlInstaller'])) 
	? $this->config['baseUrlInstaller']
//	: rtrim(\webfan\hps\patch\Fs::getPathUrl($this->getStub()->location), \DIRECTORY_SEPARATOR.'/ ').\DIRECTORY_SEPARATOR.basename($_SERVER['PHP_SELF']);
	: rtrim(\webfan\hps\patch\Fs::getPathUrl($_SERVER['PHP_SELF']), \DIRECTORY_SEPARATOR.'/ ').\DIRECTORY_SEPARATOR.basename($this->stub->location);
	  
	  return $this->config;
  }	
	
  protected function setStub($stub){
	  $this->stub=$stub;
	  return $this;
  }		
  public function getStub(){
	  if(null === $this->stub){
	       $StubRunner = require __FILE__;		  
           $this->stub = $StubRunner->getStub();
	  }
	  
	  return $this->stub;
  }	
		
    public function serialize() {
       $reflect = new \ReflectionObject($this);
       $props   = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
	   
		$state = [];
		
		foreach ($props as $prop) {
          //   print $prop->getName() . "\n";
			if(!is_scalar($this->{$prop->getName()}) && !is_array($this->{$prop->getName()}) 
			   && (!is_object($this->{$prop->getName()}) || true !== $this->{$prop->getName()} instanceof \webfan\hps\patch\ngScope)
			  ){
			  continue;	
			}
		//	$state[$prop->getName()] = serialize($this->{$prop->getName()});
			$state[$prop->getName()] =(!is_object($this->{$prop->getName()}) || true !== $this->{$prop->getName()} instanceof \webfan\hps\patch\ngScope)
				 ? $this->{$prop->getName()}
			     : $this->{$prop->getName()}->export();
        }
		
		
        return serialize($state);
    }
	
	
    public function unserialize($data) {
		$scopes = ['config'];
		
        foreach(unserialize($data) as $k => $v){
			if(in_array($k, $scopes)){
   			  $this->{$k} = new \webfan\hps\patch\ngScope($v);
			}else{
				 $this->{$k} = $v;
			}
		}
		
	//	$this->stub = self::getInstance()->getStub();
    }
	
 public function clearSession(){
      unset($_SESSION[self::SESSIONKEY]['webfan.app.shield']);
	//  unset($_SESSION[self::SESSIONKEY]['time']);
  }
	
	
 public function persist(){
//	  $_SESSION[self::SESSIONKEY]['state'] = serialize($this-> getContainer()->get('webfan.app.fsm'));
//	  $_SESSION[self::SESSIONKEY]['state.user'] = serialize($this-> getContainer()->get('webfan.app.fsm.user'));
	//  $_SESSION[self::SESSIONKEY]['webfan.app.shield'] = serialize( $this->getContainer()->get('webfan.app.shield') );
	  $_SESSION[self::SESSIONKEY]['webfan.app.shield'] = serialize( $this );
	  $_SESSION[self::SESSIONKEY]['time'] = time();
//	   print_r($_SESSION[self::SESSIONKEY]['state']);
//	   print_r($_SESSION[self::SESSIONKEY]['state.user']);
	  //webfan.app.shield
  }
	
	
 public function clearPeristant(){
	  unset($_SESSION[self::SESSIONKEY]['webfan.app.shield']);
	  unset($_SESSION[self::SESSIONKEY]['time']);
  }	
	
	
  public function getLockFile(Shield $AppShield = null){
	 if(null===$AppShield){
		$AppShield = $this; 
	 }
	$lockfile = str_replace('.php', '.lock', $AppShield->stub->location);
	if(!file_exists($lockfile)){
	  @chmod(dirname($lockfile), 0755);	
	  file_put_contents($lockfile, '');	
	}
    return $lockfile;
  }


	
	
  public function updateSelf(){
	
	  
	   set_time_limit(180);
	  $config = $this->getConfig();
	
	  if(empty($config['workspace']))$config['workspace']='frdl.webfan.de';
	  
	  $client = new \PhpJsonRpc\Client('https://'.$config['workspace'].'/software-center/modules-api/rpc/0.0.2/',
    \PhpJsonRpc\Client::ERRMODE_EXCEPTION);
      $result = $client->call('frdl.apc.download', []);

	  
	  if(!isset($result[1]) || !isset($result[1]['contents']) ){
		 return false;  
	  }
	  
	  
	   ignore_user_abort(true);  
	  
	  //'webfan.app.mutex.lock.stub'
	 //  $mutex = new \malkusch\lock\mutex\FlockMutex(fopen($this->getLockFile($this), "r"));
	 $mutex = self::getInstance()->getContainer()->get('webfan.app.mutex.lock.stub');
	  $AppShield = $this;
	  
	  $method = __METHOD__;
	  $success = $mutex->synchronized(function () use ( $AppShield, $result, $method) : bool {
		 set_time_limit(300);
		
		   $tmpfname = tempnam($AppShield->getCacheDir(), 'frdl_stub');
		   $tmpfname_backup = tempnam($AppShield->getCacheDir(), 'frdl_stub_backup');
			  
		  $AppShield->getStub()->lint(false);
		  
			$oldLocation = $AppShield->getStub()->location;
		  //  $oldConfig = self::getInstance()->getStubConfig();
			  
		    file_put_contents($tmpfname, base64_decode($result[1]['contents']));
           
			  if(!\frdl\Lint\Php::lintFileStatic($tmpfname, false)){
				   unlink($tmpfname);
				  trigger_error('Php parsing error in installer stub found, update failed in '.$method, \E_USER_ERROR);
				  throw new \Exception('Php parsing error in installer stub found, update failed in '.$method);
				  return false;  
			  }
		  
		  
		      $config = (is_object($AppShield->config) && $AppShield->config instanceof \webfan\hps\patch\ngScope) ? $AppShield->config : new \webfan\hps\patch\ngScope($AppShield->config);
			  $oldStubConfig = $AppShield->getStubConfig();
		  
		  
			try{
			  if(isset($config->wsdir) && is_dir($config->wsdir) 		 
				 && file_exists($config->wsdir.self::CONFIG_FILENAME) ){		  
				  $configFileConfig = require $config->wsdir.self::CONFIG_FILENAME;		 
			  }else{
				 $configFileConfig = [];  
			  }
			}catch(\Exception $e){
			   $configFileConfig = [];	
			}
			
			  
			  //unset($configFileConfig['hashed_password']);
			//  unset($oldStubConfig['hashed_password']);
			  
			$newConfig =array_merge($oldStubConfig, $configFileConfig);  
		// 	if(isset($newConfig['hashed_password']))unset($newConfig['hashed_password']);  

		if(!defined('\___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___')){  
		  define('\___BLOCK_WEBFAN_MIME_VM_RUNNING_STUB___', true);
		}
		  
		  
		  
			   set_time_limit(900);
		   //   $vm = \webfan\hps\Compile\MimeStub2::vm($tmpfname, strpos(file_get_contents($tmpfname), '__halt_compiler' ));	
			  require $tmpfname;
			  $vm = $run($tmpfname, false);
			  $vm->lint(false);
		    //
			 
			//  $newStubConfig = $vm->_run_php_1($vm->get_file($vm->document, '$HOME/apc_config.php', 'stub apc_config.php'));
		  
		       $vm->get_file($vm->document, '$HOME/apc_config.php', 'stub apc_config.php')
			  ->  setBody('
			    return '.var_export(array_merge( $newConfig, [
				  'hashed_password' => (isset($oldStubConfig['hashed_password'])) ? $oldStubConfig['hashed_password'] : $newConfig['hashed_password'], 
				]), true).';
			  ')
			  ;			  
			 /**/
			
			
			//  $AppShield->clearPeristant();
			 // \webfan\hps\patch\Fs::pruneDir($AppShield->getCacheDir('PSR4'), time() -  max(filemtime($vm->location), $time), true, true);
		 	 //  usleep(100);

				 	
	  
			     
			  
			  $time = time();
			//  $vm->location = $AppShield->getStub()->location;	
			  //file_put_contents($oldLocation, file_get_contents($tmpfname));
			
			

			  
				  
			  
			  
				  
			  file_put_contents($tmpfname_backup, file_get_contents($oldLocation) );
			
			  try{			    
			   // file_put_contents($oldLocation, file_get_contents($tmpfname));
				  $vm->location = $AppShield->getStub()->location;	
				  
			  //  $AppShield->setConfig($newConfig, true, true);
			  }catch(\Exception $e){
				 file_put_contents($oldLocation, file_get_contents($tmpfname_backup)); 
		         print_r($e->getMessage());  
		        return false;
	         }  
			  
			
			  
			  
						  
	    call_user_func(\frdlweb\Thread\ShutdownTasks::mutex(), function($CacheDir, $tmpfname, $tmpfname_backup){
			if(file_exists($tmpfname)){
				unlink($tmpfname); 
			}
			if(file_exists($tmpfname_backup)){
				unlink($tmpfname_backup); 
			}			
		   \webfan\hps\patch\Fs::pruneDir($CacheDir, 12 * 60 * 60, true, true);
	    }, $AppShield->getCacheDir(), $tmpfname, $tmpfname_backup);	  
			  
			  
			  
			  
			  
			  
		  return true;
	  });
	  
	  
	  return $success;
  }
	
	
	
  public function setConfig($config, $save = false, $saveFile = false){
	  $this->config = (is_object($config) && $config instanceof \webfan\hps\patch\ngScope) ? $config : new \webfan\hps\patch\ngScope($config);
	 // $this->config = $config;
	  if(true===$save && null!==$this->getStub()){
		  $export = $this->config->export();
		  unset($export['imports']);
	//	  unset($export['wsdir']);
		  
		  $this->getStub()->get_file($this->stub->document, '$HOME/apc_config.php', 'stub apc_config.php')
			  ->  setBody('
			    return '.var_export($export, true).';
			  ')
			  ;		 
		  
	  
	  }
	  
		
	  if(true===$save && true===$saveFile && null!==$this->stub){
	      $AppShield = $this;
		  //  $mutex = new \malkusch\lock\mutex\FlockMutex(fopen($this->getLockFile($this), "r"));
		   $mutex = self::getInstance()->getContainer()->get('webfan.app.mutex.lock.stub');
		   $mutex->synchronized(function () use ( $AppShield , $export ) {
	        	$AppShield->getStub()->location = $AppShield->getStub()->location;	
	      
			  	
		  $configFile = rtrim($AppShield->config->wsdir, \DIRECTORY_SEPARATOR.' ').\DIRECTORY_SEPARATOR.self::CONFIG_FILENAME;
	       if(file_exists( $configFile) ){
		
			$e = var_export($export, true);   
$t = time();			   
$banner = <<<BANNER
/* This file was generated by Webfan Php-Installer, you SHOULD not edit this file manually! $t */
BANNER;
			   
			   
			  file_put_contents($configFile, <<<PHPCODE
<?php
$banner
return $e;
PHPCODE
							   );   
		   }	
		  
		 });  
		  
		  
		  
	  }	  
	  
	  return $this;
  }	
		
	
	
	
  public function loadConfig(){
	  /*
	  		  isset($this->config['imports']['frdl.config.stub.php']) && 
		  isset($this->config['imports']['frdl.config.app.php']) && 
		  isset($this->config['imports']['frdl.config.install.php']) && 
		  isset($this->config['imports']['frdl.config.update.php']) && 
		  isset($this->config['imports']['frdl.index.php']) && 
		  isset($this->config['imports']['frdl.version.php']) && 
		  isset($this->config['imports']['frdl.feature-implementations.php']) && 
		  */
	   $this->__configLoaded =true;
	  
	  if(!is_array($this->config) || !count($this->config) ){
		  $this->setConfig($this->getStubConfig(), false, false);	 
	  }
	  
	  $this->config = (is_object($this->config) && $this->config instanceof \webfan\hps\patch\ngScope) ? $this->config : new \webfan\hps\patch\ngScope($this->config);
	  
      $this->getV(isset($_REQUEST['force']) && 'update-check' === $_REQUEST['force']);	
	  
          $_ENV['FRDL_HPS_CACHE_DIR'] = $this->getCacheDir();
	      $_ENV['FRDL_HPS_PSR4_CACHE_DIR'] = $this->getCacheDir('PSR4');
	  
//$this->config = new \webfan\hps\patch\ngScope([]);
//$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] = (isset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'])) ? intval($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']) : time() - intval($this->latest->time);
	  /*
$_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] =  max(0,
										  time() - max((((!isset($this->config['autoupdate']) 
													  || true === $this->config['autoupdate']
													  || 'true' === $this->config['autoupdate'])) 
													? intval($this->latest->time)
													: 0),
												   filemtime($this->stub->location))
										  );	  	  
	  
	  */
    $_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] =  time() - filemtime($this->stub->location);		  
	  
	$this->config->baseUrl = (isset($this->config->baseUrl)) ? $this->config->baseUrl : \webfan\hps\patch\Fs::getPathUrl();
    $this->config->baseUrlInstaller = (isset($this->config->baseUrlInstaller)) 
	? $this->config->baseUrlInstaller 
	//: rtrim(\webfan\hps\patch\Fs::getPathUrl($_SERVER['PHP_SELF'], true), \DIRECTORY_SEPARATOR.'/ ').'/'.basename($this->stub->location);	   
	// : explode('?', \webfan\hps\patch\Fs::getPathUrl($_SERVER['PHP_SELF'], true).$_SERVER['REQUEST_URI'], 2)[0]
		: $this->config->baseUrl.basename($this->stub->location)
		  ;
	  
	  if(isset($this->config->wsdir) && is_dir($this->config->wsdir) 
		  && file_exists($this->config->wsdir.self::CONFIG_FILENAME) ){
		  $i = require $this->config->wsdir.self::CONFIG_FILENAME;
		  $this->config->import($i);
	  }else{
		set_time_limit(120);  
		  $time = time();
		//$finder = $this->container->get('finder');	
		$finder =  new \Symfony\Component\Finder\Finder();
		$finder->name('*'.self::CONFIG_FILENAME)								
			         ->ignoreUnreadableDirs()
					 ->ignoreVCS(false)
			;			
		//  if(!isset($this->config->wsdir) || !is_dir($this->config->wsdir)){
			$sDir = \webfan\hps\patch\Fs::getRelativePath(getcwd(),dirname($this->stub->location));
		 // }
		  
		
		    $sDir_2 = \webfan\hps\patch\Fs::getRelativePath(getcwd(), dirname($_SERVER['DOCUMENT_ROOT']));
		  
		  
		     if(!($HOME = getenv('FRDL_HOME'))){
				 $HOME =  \webfan\hps\patch\Fs::getRelativePath(getcwd(), \webfan\hps\patch\Fs::getRootDir($_SERVER['DOCUMENT_ROOT']));
			 }
			
		 $finder->depth('< 5');
		  
         //foreach ($finder->in([$sDir, $sDir_2] )//->files() as $file) {
		  foreach ($finder->in($HOME) as $file) {	 
                       //  $absoluteFilePath = $file->getRealPath();
                      //  $fileNameWithExtension = $file->getRelativePathname();
                      //$file->getContents()
			 		  $i = require $file->getRealPath();
		              $this->config->import($i);
			 break;
         } 	  
	  }
	  
	  
	
	 
	  
	  
	$Event = new \webfan\hps\Event('loaded:config');
	$Event->setArgument('Shield', $this);
	$Event->setArgument('container', $this->getContainer());  
	$Event->setArgument('config', $this->config); 
	$this->getEmitter()->emit($Event->getName(), $Event);    
	  
	  
	  return $this;
  }
	
	
	
	
	//getContainer()
  public function getStubConfig(){
	  if(null!==$this->stub){
	     $config = $this->stub->_run_php_1($this->stub->get_file($this->stub->document, '$HOME/apc_config.php', 'stub apc_config.php'));	 
	     unset($config['imports']);
	     return $config;  
	  }elseif(null!==self::getInstance($this->getStub())->getStub()){
	     $config = self::getInstance($this->getStub())->
			 getStub()->_run_php_1(self::getInstance($this->getStub())
								   ->getStub()->get_file(self::getInstance($this->getStub())
														 ->getStub()->document, '$HOME/apc_config.php', 'stub apc_config.php'));	 
	     unset($config['imports']);
	     return $config;		  
	  }else{
		 throw new \Exception('No stub set in '.__METHOD__);  
	  }	
  }
	
  public function getV($reload = false){
	  
	  
	$Event = new \webfan\hps\Event('loaded:version');
	$Event->setArgument('Shield', $this);
	$Event->setArgument('container', $this->getContainer());  
  
	  
	  
	  if(true!==$reload && null!==$this->v && null!==$this->version){
	     $Event->setArgument('version', $this->version); 
	     $this->getEmitter()->emit($Event->getName(), $Event);  		  
		return $this->version;  
	  }
	  
	  if(!is_dir($this->getCacheDir())){
		mkdir($this->getCacheDir(), 0755, true);  
	  }
	  
    $vFile =$this->getCacheDir() . 'v.json';
   if(true===$reload || !file_exists($vFile) || filemtime($vFile) < time() - 60 * 10){	  
  	$_url = 'https://'. ((isset($this->config['workspace'])) ? $this->config['workspace'] : 'frdl.webfan.de'   )
		              .'/install/version.php';

	 $vc = file_get_contents($_url);  
     if(!is_string($vc)){
		throw new \Exception(sprintf('Cannot load version informations from %s',  $_url));
	 }
     file_put_contents($vFile, file_get_contents($_url)); 	
   }
	$this->v = json_decode(file_get_contents($vFile));  
	$this->v->versions=(array)$this->v->versions;
//	ksort($this->v->versions);  
	$this->v->versions = new \webfan\hps\patch\ngScope($this->v->versions);  
	$this->latest = $this->v->versions->{$this->v->latest};	  
	//$this->config->latest=$this->latest; 
	  
	  
//	if(isset($this->config['imports']) 
//	   && isset($this->config['imports']['frdl.version.php'])   
//	   ){
//		$this->v_current =  new \webfan\hps\patch\ngScope($this->config['imports']['frdl.version.php']);  
	//}
	   

	  $this->version = $this->stub->_run_php_1($this->stub->get_file($this->stub->document, '$HOME/version_config.php', 'stub version_config.php'));	
	  
	
	  $Event->setArgument('version', $this->version); 	
	  $this->getEmitter()->emit($Event->getName(), $Event);  
	  
	  return $this->v;
  }
	
	
	
  public function isAutoupdate(){
	return !isset($this->config['autoupdate']) || (0 !== $this->config['autoupdate'] && false !== $this->config['autoupdate'] && 'false' !== $this->config['autoupdate'])
		? true 
		: false;  
  }
	
	
  public function checkForAutoSelfUpdate(){
if($this->isAutoupdate()){
	  	  
$latest_time = intval($this->latest->time);	  
$sk = 'already_refreshed_'.sha1(__FILE__. ' '.$latest_time);	
$stub_time = filemtime($this->stub->location);	 
$AppShield = $this;	
	
	if($this->session_started() && isset($_SESSION[$sk]) && intval($_SESSION[$sk])>=20){
		$_SESSION[$sk]++;
		if($_SESSION[$sk]>25){
		  unset($_SESSION[$sk]);	
		}
	}

	\frdl\webfan\App::God(false)->refreshPageIf(2, 
												function() use($sk, $AppShield){
													return $AppShield->session_started() && isset($_SESSION[$sk]) && 20 === intval($_SESSION[$sk]) && 'GET' === $_SERVER['REQUEST_METHOD']	    
														? false
														: true;
												},
												function() use($sk, $AppShield){ 
												   $_SESSION[$sk]=21; 
												// 	$AppShield->terminate();
													die();
												},
												'<p>An cache/version update may take a little moment.</p>',
                                                 [ ]
												);
	
	
	\frdl\webfan\App::God(false)->refreshPageIf(10, 
												function() use($sk, $AppShield){
													return $AppShield->session_started() && isset($_SESSION[$sk]) && 0 === intval($_SESSION[$sk]) && 'GET' === $_SERVER['REQUEST_METHOD']
														     && true===$AppShield->updateAvailable
														? false
														: true;
												},
												function() use($sk, $AppShield){ 
												   $_SESSION[$sk]=20; 
													
												 	$AppShield->terminate();
													// call_user_func_array(\frdlweb\Thread\ShutdownTasks::mutex(), [function($AppShield){
													   $AppShield->updateSelf();	
													// }, $AppShield]);
													//$AppShield->terminate();
													
													die();
												},
												'<p>An cache/version update may take a little moment.</p>',
                                                 [ ]
												);
												

	
\frdl\webfan\App::God(false)->refreshPageIf(2, function() use($sk, $latest_time, $stub_time, $AppShield) {

  
 
 	return  (		
	//  $stub_time < time() - $_ENV['FRDL_HPS_PSR4_CACHE_LIMIT'] 	
  //  && ($stub_time<$latest_time)
	// &&
		true===$AppShield->updateAvailable
  )
		 && ($AppShield->session_started() && (!isset($_SESSION[$sk]) || intval($_SESSION[$sk]) > 25) ) 
		
		 && 'GET' === $_SERVER['REQUEST_METHOD']
		&& !isset($_GET['web']) 
		
     ? false : true
  ;
   
},
function() use($sk, $AppShield) {
	$_SESSION[$sk]=0;
	// $AppShield->terminate();

	die();
},
'<p>An cache/version update may take a little moment.</p>',
[ ]
);
	  
}//if(!isset($this->config['autoupdate']) || true === $this->config['autoupdate']){ 
	  else{
		unset($_ENV['FRDL_HPS_PSR4_CACHE_LIMIT']);  
	  }
  }
	
	
  public static function mxGetARandomString($laenge = 32, $string_ = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
  {
                $randstr = '';

                
                mt_rand((double)microtime()*1000000,(double)microtime()*1000000+9999999);

                for ($i=1; $i <= $laenge; $i++)
                     {
                        $randstr.= substr($string_, mt_rand(0,strlen($string_)-1), 1);
                     }
   return $randstr;
  }	
	
	
	
 public function getCacheDir($name = ''){
	 $name = strtoupper($name);
	 
	 if(!isset($_ENV['FRDL_HPS_CACHE_DIR']))$_ENV['FRDL_HPS_CACHE_DIR']=getenv('FRDL_HPS_CACHE_DIR');
	 if(!isset($_ENV['FRDL_HPS_PSR4_CACHE_DIR']))$_ENV['FRDL_HPS_PSR4_CACHE_DIR']=getenv('FRDL_HPS_PSR4_CACHE_DIR');
	 
		  $_ENV['FRDL_HPS_CACHE_DIR'] = ((!empty($_ENV['FRDL_HPS_CACHE_DIR'])) ? $_ENV['FRDL_HPS_CACHE_DIR'] 
                   : sys_get_temp_dir() . \DIRECTORY_SEPARATOR . get_current_user(). \DIRECTORY_SEPARATOR . 'cache' . \DIRECTORY_SEPARATOR
					  );
	  
	  
          $_ENV['FRDL_HPS_PSR4_CACHE_DIR'] = ((!empty($_ENV['FRDL_HPS_PSR4_CACHE_DIR'])) ? $_ENV['FRDL_HPS_PSR4_CACHE_DIR'] 
                   : $_ENV['FRDL_HPS_CACHE_DIR']. 'psr4'. \DIRECTORY_SEPARATOR
					  );
 
	 
	$Event = new \webfan\hps\Event('loaded:config:caches');
	$Event->setArgument('Shield', $this);
	$Event->setArgument('container', $this->getContainer());  
	$this->getEmitter()->emit($Event->getName(), $Event);  
	 
	 
	 return (empty($name)) ? $_ENV['FRDL_HPS_CACHE_DIR'] : $_ENV['FRDL_HPS_'.$name.'_CACHE_DIR'];
 }
	
	
	
	
	
	
   
  public function registerEvents(){
	  
	  //Shield.initialized
  $this->getEmitter()->once('Shield.initialized',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, \webfan\hps\Event $Event){  
	  
	 //  if(!$Event->getArgument('Shield')->isInstalled()){
	 //	return;  
	 //  }
	  if($Event->getArgument('Shield')->session_started() && !isset($_SESSION[TerminalEmulator::SESSIONKEY])){
		  $_SESSION[TerminalEmulator::SESSIONKEY]=[];   			
	  }		
	  	  
	 $path = (isset($_REQUEST['path']) && $Event->getArgument('Shield')->isAdmin(null, false)) ? $_REQUEST['path'] : 
		(
			(
				$Event->getArgument('Shield')->session_started()
				&& isset($_SESSION[TerminalEmulator::SESSIONKEY])
				&& isset($_SESSION[TerminalEmulator::SESSIONKEY]['cwd'])
				&& is_string($_SESSION[TerminalEmulator::SESSIONKEY]['cwd'])
				&& !empty($_SESSION[TerminalEmulator::SESSIONKEY]['cwd'])
			)
		  ? $_SESSION[TerminalEmulator::SESSIONKEY]['cwd']
		  : ((isset($Event->getArgument('Shield')->getConfig()->wsdir) && is_dir($Event->getArgument('Shield')->getConfig()->wsdir))
			   ? rtrim($Event->getArgument('Shield')->getConfig()->wsdir, \DIRECTORY_SEPARATOR)
			  // : \webfan\hps\patch\Fs::getRootDir(dirname($_SERVER['DOCUMENT_ROOT']))
			  : \webfan\hps\patch\Fs::getRootDir($_SERVER['DOCUMENT_ROOT'])
			 ) 
		);
		
			  
     //    die($path);
		if(@is_dir($path) 
			&& (@is_writable($path) || @is_readable($path)) 
			  &&  ($path !== getcwd() || (!isset($_SESSION[TerminalEmulator::SESSIONKEY]['cwd']) || $_SESSION[TerminalEmulator::SESSIONKEY]['cwd'] !== $path ))
		  
		  ){
		   chdir($path);	 
		   if($Event->getArgument('Shield')->session_started()){
			   $_SESSION[TerminalEmulator::SESSIONKEY]['cwd'] = getcwd();
		   }
		}else{
		   if($Event->getArgument('Shield')->session_started() &&  $_SESSION[TerminalEmulator::SESSIONKEY]['cwd'] === $path){
			   unset($_SESSION[TerminalEmulator::SESSIONKEY]['cwd']);
		   }					
		}
  });    
	 
	  
	  
	$this->getEmitter()->once('project.autoload.force', static function(string $eventName, \frdl\Flow\EventEmitter $emitter, $projectDir){  
	     $projectDir = rtrim($projectDir, \DIRECTORY_SEPARATOR);
		 $file = $projectDir.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'autoload.php';
		 if(file_exists($file)){
			require $file; 
		 }
	});    
	  
	  

	  
	 
	$this->getEmitter()->once('project.autoload.force', static function(string $eventName, \frdl\Flow\EventEmitter $emitter, $projectDir){  
	     $projectDir = rtrim($projectDir, \DIRECTORY_SEPARATOR);
		
		 $f1 = $projectDir.\DIRECTORY_SEPARATOR.'compiled'. \DIRECTORY_SEPARATOR.'RawCompiledContainer.php';
	     $f2 = $projectDir.\DIRECTORY_SEPARATOR.'compiled'.\DIRECTORY_SEPARATOR.'RawCompiledContainer.backup.php';


      \frdl\webfan\Autoloading\SourceLoader::top()
        ->class_mapping_add(\RawCompiledContainer::class,(file_exists($f1)) ? $f1 : $f2, $success) 
	       //    ->  autoload_register() 
           //   -> unregister([\frdl\webfan\Autoloading\SourceLoader::top(),'autoloadClassFromServer'])
	   ;
	
	});    
	  
  
	$this->getEmitter()->once('project.autoload.force', static function(string $eventName, \frdl\Flow\EventEmitter $emitter, $projectDir){  
	     $projectDir = rtrim($projectDir, \DIRECTORY_SEPARATOR);
		 $d = $projectDir.\DIRECTORY_SEPARATOR.'compiled'.\DIRECTORY_SEPARATOR.'~events'.\DIRECTORY_SEPARATOR;
         if(!is_dir($d)){
            mkdir($d, 0755, true);
         }
         \Webfan\App\EventModule::setBaseDir($d);
	});  
	  	  
  
	  

  $this->getEmitter()->once('ready:for:checkForAutoSelfUpdate',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, \webfan\hps\Event $Event){  
	    $Event->getArgument('container')->get('webfan.app.shield')->checkForAutoSelfUpdate(); 
  });    
	 
  $this->getEmitter()->once('before.compile',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, $eventData){
     $eventData['container']->register(new \Webfan\App\AppBuilderServiceProvider($eventData['AppShield']));
  });		  
	  
  $this->getEmitter()->once('before.rpc',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, $eventData){
     $eventData['container']->register(new \Webfan\App\Rpc\RpcServiceProvider());
  });	 
	  
	  
	  
  $this->getEmitter()->once('login.isAdmin::POST',static function(){
	
        \frdl\webfan\App::God(false)->refreshPageIf(1, 
												function() {
													return false;
												},
												function() { 
                                                  die();
												},
												'<p>Welcome!</p><p>You will be redirected...</p>',
                                                 ['title' => 'Login...' ]
												);	  

  });
	  	  
	  

	 
	/*  
   $this->emitter->once('isAdmin::POST',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, $eventData){
	                                  \frdl\webfan\App::God(false)->refreshPageIf(60, 
												function() use($eventData){
                       								$FloodProtection =  $eventData[1]->getContainer()->get('floodprotection.login.admin');
													return !$FloodProtection->check($_SERVER['REMOTE_ADDR']);
												},
												function() { 
											         header("HTTP/1.1 429 Too Many Requests");
													ob_end_flush();
													die();
												},
												'<p><error style="color:red;">Too Many Login Requests!</error><br />Please try again later!</p>',
                                                 [ ]
												);
	   
  });	 
	  */
	
  $this->getEmitter()->once('isAdmin::POST::try',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, \webfan\hps\Event $Event){  
	                                  \frdl\webfan\App::God(false)->refreshPageIf(60, 
												function() use($Event){
                       								$FloodProtection =  $Event->getArgument('Shield')->getContainer()->get('floodprotection.login.admin');
													return !$FloodProtection->check($_SERVER['REMOTE_ADDR']);
												},
												function() { 
											         header("HTTP/1.1 429 Too Many Requests");
													ob_end_flush();
													die();
												},
												'<p><error style="color:red;">Too Many Login Requests!</error><br />Please try again later!</p>',
                                                 ['title'=>'Too Many Login Requests', ]
												); 
  });
	  
	  

	 	   $this->getEmitter()->once('login.failed',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, $eventData/* ['as'=>$_POST['username'],
												  'REMOTE_ADDR'=>$_SEVER['REMOTE_ADDR'],
												  'FORWARDED_FOR'=> (isset($_SEVER['HTTP_X_FORWARDED_FOR'])) ? $_SEVER['HTTP_X_FORWARDED_FOR'] : false ]*/){
		         sleep(1);  
            });	 
	   	   
	  
	$this->getEmitter()->once('kernel.Shield.send_response',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, \webfan\hps\Event $Event){  
		 if($Event->getArgument('container')->get('webfan.app.shield')->session_started()){
	 	 
			 call_user_func(function($sessionKey){		
				 if(!isset($_SESSION[$sessionKey])){
					$_SESSION[$sessionKey]=[]; 
				 }
				 
				// if(isset($_SESSION[$sessionKey]) && isset($_SESSION[$sessionKey]['isAdmin']) && true === $_SESSION[$sessionKey]['isAdmin']){			
				//	 $_SESSION[$sessionKey]['lasthit.admin'] = time();			
				// }		  
				 $_SESSION[$sessionKey]['lasthit'] = time(); 		
			 }, self::SESSIONKEY);	
		 }
	}); 
	  
	  

	       			  
	
		  
	  

	    

	  $this->getEmitter()->on('kernel.Shield.send_response',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, \webfan\hps\Event $Event){  
	         $Event->getArgument('container')->get('webfan.app.shield')->clear_duplicate_cookies();
      });  	  
	  
	  
	  $this->getEmitter()->once('kernel.Shield.send_response',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, \webfan\hps\Event $Event){  
		    // if($Event->getArgument('container')->get('webfan.app.shield')->session_started()){
			//	 session_write_close();
			// }
		  //if($Event->getArgument('container')->get('webfan.app.shield')->session_started()){
		 //  $_SESSION[TerminalEmulator::SESSIONKEY]['cwd'] = getcwd();
		//  }
      });      
	  
	/*  
	  $this->getEmitter()->on('kernel.Shield.send_response',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, \webfan\hps\Event $Event){  
		     //  !ob_get_length() && ob_start();
               if( !headers_sent()  ){		  
		          $size=ob_get_length();
                  header("Content-Length: $size"); 	 
				  header('Connection: close');			
			   }
      });      
	 

     		   $Event = new \webfan\hps\Event('session:started');	   
			   $Event->setArgument('SESSION_NAME', session_name());			       
			   $this->getEmitter()->emit($Event->getName(), $Event);   
 */
	  $this->getEmitter()->once('session:started',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, \webfan\hps\Event $Event){ 	
	    $SESSIONKEY = $Event->getArgument('SESSIONKEY');
		  
		  if(!isset($_SESSION[$SESSIONKEY])){		
			  $_SESSION[$SESSIONKEY] = [];	
		  }

		  if(!isset($_SESSION[$SESSIONKEY]['breaker'])){		
			  $_SESSION[$SESSIONKEY]['breaker'] = [];	
		  }		  

	  });  	  

	  
	  $this->getEmitter()->once('initialize:before',static function(string $eventName, \frdl\Flow\EventEmitter $emitter, \webfan\hps\Event $Event){ 	
		  if(!in_array('ob_gzhandler', ob_list_handlers()))ob_start('ob_gzhandler');
		  $Event->getArgument('Shield')->ob_start([$Event->getArgument('Shield'), 'onBeforeResponse']);
  		  $Event->getArgument('Shield')->session_start(); 
		  $Event->getArgument('Shield')->loadConfig();	     
	  });  
	  
  }   
	
	public function onBeforeResponse(string $content = null){	
		
		if(!is_string($content)){
		   $content = ob_get_contents();	
		   $size=ob_get_length();
		}else{
			$size=  strlen($content);
		}
		      
		       if( !headers_sent()  ){		  
                  header("Content-Length: $size"); 	 
				  header('Connection: close');			
			   }



		return $content;
	}
	
	
	public function ob_start($fn = null){
	
       // if(!headers_sent() 
		//  && !ob_get_level()
		//  ){
	       return null !== $fn ? ob_start($fn) : !ob_get_length() && ob_start();
      //  }	
		
		// return ob_get_level();
	}
	
	
	protected function _session_started(){ 
     if ( strtolower(substr(\php_sapi_name(), 0, strlen('cli'))) !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === \PHP_SESSION_ACTIVE ? true : false;
        } else {
            return session_id() === '' ? false : true;
        }
     }
     return false;
   }
	

	
	public function session_started(){		
       if(true === $this->_session_started()){
     		   $Event = new \webfan\hps\Event('session:started');	   
			   $Event->setArgument('SESSION_NAME', session_name());
		       $Event->setArgument('SESSIONKEY', self::SESSIONKEY);	
			   $this->getEmitter()->emit($Event->getName(), $Event);   
		   return true;
	   }else{
		 return false;   
	   }
   }
	
	
	
	
public function session_switch($name = "PHPSESSID") {	
	
			   $Event = new \webfan\hps\Event('session:start');	   
			   $Event->setArgument('SESSION_NAME', $name);	   
	           $Event->setArgument('SESSIONKEY', self::SESSIONKEY);	
			   $this->getEmitter()->emit($Event->getName(), $Event);  

	    $this->session_set_cookie_params();
	
        if ($this->session_started()) { // if a session is currently opened, close it
            session_write_close();
        }
	
	
        session_name($name);
	    $iS = false;
        if (isset($_COOKIE[$name])) {    // if a specific session already exists, merge with $created_sessions
            self::$created_sessions[$name] = $_COOKIE[$name];
        }
        if (isset(self::$created_sessions[$name])) { // if existing session, impersonate it
			try{
            session_id(self::$created_sessions[$name]);
            $iS = @session_start() ? true : false;
			}catch(\Exception $e){
				$iS = false;
			}
        }
	

         if(false === $iS) { // create new session
            session_start();
			
          //  $_SESSION = [];
			
			// empty content before duplicating session file
                        // duplicate last session file with new id and current $_SESSION content
                        // If this is the first created session, there is nothing to duplicate from and passing true as argument will take care of "creating" only one session file
            session_regenerate_id(empty(self::$created_sessions));
            self::$created_sessions[$name] = session_id();
        }
	

     if (ini_get('session.use_cookies')){  
		$p = session_get_cookie_params();  
        setcookie(session_name(),session_id(),time()+24 * 60 * 60, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
     }
}
	
	
	
  public function session_destroy(){
      $_SESSION = [];
     // $this->session_set_cookie_params();
	  $_SESSION = [];

	  if (ini_get('session.use_cookies')){  
		  $p = session_get_cookie_params();  
		  setcookie(session_name(), '', time() - 31536000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
	  }

		       $Event = new \webfan\hps\Event('session:destroy');	   
			   $Event->setArgument('SESSION_NAME', session_name());	 
		       $Event->setArgument('SESSIONKEY', self::SESSIONKEY);	
			   $this->getEmitter()->emit($Event->getName(), $Event);	  

	  session_unset();
	  session_destroy();
  }
	

  public function session_set_cookie_params(){
	  $p = parse_url($_SERVER['REQUEST_URI']);
	  session_set_cookie_params(time() + 24 * 60 * 60, $p['path'], '.' . $_SERVER['HTTP_HOST'], 0, 1);
  }
	

  public function session_start(){
   
     if(!$this->session_started()){	   	    
	   ini_set("session.auto_start" , '0'); // Auto-start session          
	   ini_set("session.gc_probability" , 10); // Garbage collection in % MUST be > 0          
	   ini_set("session.serialize_handler", 'php_serialize'); // How to store data          
	   ini_set("session.use_cookies" , '1'); // Use cookie to store the session ID           
	   ini_set("session.gc_maxlifetime" , 24 * 60 * 60); // Sekunden Inactivity timeout for user sessions           
	   ini_set("url_rewriter.tags" , ''); // verhindern, dass SID an URL gehaengt wird
	   ini_set("session.use_only_cookies", "1");
	   ini_set("session.cookie_samesite" , 'Strict'); 
	   session_cache_limiter('private, must-revalidate');
		 	       
		       $Event = new \webfan\hps\Event('session:config');	   
			   $Event->setArgument('SESSION_NAME', self::SESSION_NAME);	 
		       $Event->setArgument('SESSIONKEY', self::SESSIONKEY);	
			   $this->getEmitter()->emit($Event->getName(), $Event);  
		 
	   $this->session_switch(self::SESSION_NAME);
     }	 
		
   	return $this->session_started();
 }	
	
 public function clear_duplicate_cookies() {
    // If headers have already been sent, there's nothing we can do
    if (headers_sent()) {
        return;
    }

    $cookies = array();
    foreach (\headers_list() as $header) {
        // Identify cookie headers
        if (strpos($header, 'Set-Cookie:') === 0) {
            $cookies[] = $header;
        }
    }
    // Removes all cookie headers, including duplicates
    \header_remove('Set-Cookie');

    // Restore one copy of each cookie
    foreach(array_unique($cookies) as $cookie) {
        header($cookie, false);
    }
}
	
	
	
  public function initialize(){



	          
	    if(isset($this->initilaized) && true===$this->initilaized){
		   return $this;	
		}
	  
	    $this->initilaized = true;
	  
	  if(null === self::$instance){
		  self::$instance = &$this;
	  } 

	  
	  
	  if(\spl_object_id(self::$instance) !== \spl_object_id($this) ){
		  throw new \ErrorException('Only singletone instances can be initialized by '.__METHOD__);  
	  }
      
			 
	  

  //for composer...
    $userEnv = defined('\PHP_WINDOWS_VERSION_MAJOR') ? 'APPDATA' : 'HOME';
    $userDir = getenv($userEnv);	  
	if(!$userDir){
		putenv($userEnv.'='.\webfan\hps\patch\Fs::getRootDir($_SERVER['DOCUMENT_ROOT']));
	}
	  


	           $Event = new \webfan\hps\Event('initialize:before');	   
			   $Event->setArgument('Shield', $this);	   
			   $Event->setArgumentReference('container', $this->container);  	   
			   $this->getEmitter()->emit($Event->getName(), $Event);   



	  


	  

	  
 	  
	  
	  
	  
	  
	  
	  


	  
	  
	  
  

$installLoader       = new \Finite\Loader\ArrayLoader([
    'class'         => '\Webfan\App\Shield',
    'graph'         => 'install',
    'property_path' => 'installStatus',
    'states'        => [
        'uninstalled'  => ['type' => \Finite\State\StateInterface::TYPE_INITIAL],
        'loading'  => ['type' => \Finite\State\StateInterface::TYPE_NORMAL,
					         'properties' => [
					             'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,
					      ]],		
		
        'prepared'  => ['type' => \Finite\State\StateInterface::TYPE_NORMAL,
					         'properties' => [
					             'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,
					      ]],		
		
		
        'installed' => ['type' => \Finite\State\StateInterface::TYPE_FINAL,
					      'properties' => [
					         'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,
					   ]],
		
        'running' => ['type' => \Finite\State\StateInterface::TYPE_FINAL,
					      'properties' => [
					         'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,
					   ]],
		
		
        'rpc' => ['type' => \Finite\State\StateInterface::TYPE_FINAL,
					      'properties' => [
					         'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,
					   ]],		
		
	/*			   
        'failed' => ['type' => \Finite\State\StateInterface::TYPE_FINAL],
        'installing'  => ['type' => \Finite\State\StateInterface::TYPE_NORMAL,
					   'properties' => [
					      'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,
					   ]],
        'updating'  => ['type' => \Finite\State\StateInterface::TYPE_NORMAL,
					   'properties' => [
					      'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,
					   ]],
        'installing.admin'  => ['type' => \Finite\State\StateInterface::TYPE_NORMAL],
        'installing.paths'  => ['type' => \Finite\State\StateInterface::TYPE_NORMAL],
        'installing.finish'  => ['type' => \Finite\State\StateInterface::TYPE_NORMAL],
		*/
		
    ],
    'transitions'   => [
        'load' => ['from' => ['uninstalled'//, 'installing.finish'
							 ], 
				   'to' => 'loading', 
				//   'guard' => [$this->container->get('webfan.app.shield'), 'isLoading'],
				    'guard' => [$this, 'isLoading'],
					    
				   'properties' => [
					         'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,
					   ],
            'configure_properties' => static function(\Symfony\Component\OptionsResolver\OptionsResolver $optionsResolver) {
                $optionsResolver->setRequired('wsdir');
            }],
		
		
        'run' => ['from' => ['uninstalled', 'loading', 'prepared'], 
				//  'to' => 'installed', 'guard' => [$this->container->get('webfan.app.shield'), 'isInstalled'],
				   'to' => 'installed', 'guard' => [$this, 'isInstalled'],
					    
				  'properties' => [
					         'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,
					   ],
            'configure_properties' => static function(\Symfony\Component\OptionsResolver\OptionsResolver $optionsResolver) {
                $optionsResolver->setRequired('wsdir');
            }],

        'prepare' => ['from' => ['uninstalled', 'loading'], 
				//  'to' => 'prepared', 'guard' => [$this->container->get('webfan.app.shield'), 'isPrepared'],
					   'to' => 'prepared', 'guard' => [$this, 'isPrepared'],
					    
				  'properties' => [
					         'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,
					   ],
            'configure_properties' => static function(\Symfony\Component\OptionsResolver\OptionsResolver $optionsResolver) {
                $optionsResolver->setRequired('wsdir');
            }],		
		
    ],
	
	 'callbacks' => [

        'after' => [
            [              			 
			   'to' => ['run'], 
			   'do' =>  static function(\Finite\StatefulInterface $AppShield, \Finite\Event\TransitionEvent $e) {
				  //  $sm = $AppShield->getContainer()->get('webfan.app.fsm');
				      chdir($AppShield->config->wsdir);
                    
                },
            ],
			
			
        ]
    ],
]);


	  
$stateMachine = $this->container->get('webfan.app.fsm');
$installLoader->load($stateMachine);
//$stateMachine->setObject( new self($this->container, $this->stub, false));
//$stateMachine->setObject( $this->container->get('webfan.app.shield'));
$stateMachine->setObject( $this);
$stateMachine->initialize();
	  
	 
	
	  
	    //return $this;
$userLoader       = new \Finite\Loader\ArrayLoader([
    'class'         => '\Webfan\App\Shield',
    'graph'         => 'user',
    'property_path' => 'userStatus',
    'states'        => [
        'guest'  => ['type' => \Finite\State\StateInterface::TYPE_INITIAL],
        'admin' => ['type' => \Finite\State\StateInterface::TYPE_FINAL],
    ],
    'transitions'   => [
       // 'login' => ['from' => ['guest'], 'to' => 'admin', 'guard' => [$this->container->get('webfan.app.shield'), '_isAdmin']],
		'login' => ['from' => ['guest'], 'to' => 'admin', 'guard' => [$this, '_isAdmin']],
        'logout' => ['from' => ['guest'], 'to' => 'guest'],

    ],
	

	
	 'callbacks' => [

        'after' => [
            [              			 
			   'to' => ['logout'], 
			   'do' => static function(\Finite\StatefulInterface $AppShield, \Finite\Event\TransitionEvent $e) {
                 //   echo 'Applying transition '.$e->getTransition()->getName(), "\n";
				   //  if(isset($_SESSION[self::SESSIONKEY]['isAdmin'])){
						 $_SESSION[self::SESSIONKEY]['isAdmin'] = false;
					// }
				   			
				   $_SESSION[self::SESSIONKEY]['user'] = [				  
					   'sec_fingerprint' => $AppShield->fingerprint(),            
				   ];


				 //    $AppShield->persist();
                },
            ]
        ]
    ],
	
]);
	  
	  
$stateMachineUser = $this->container->get('webfan.app.fsm.user');	  
$userLoader->load($stateMachineUser);	  
//$stateMachineUser->setObject( new self($this->container, $this->stub, false));
$stateMachineUser->setObject($this->container->get('webfan.app.shield.user') );
	  
$stateMachineUser->initialize();	  
	    

	  
	  
	  if($this->isAdmin($stateMachineUser, 'POST'===$_SERVER['REQUEST_METHOD'] && isset($_POST['op_login']) && self::$loginAttempts<=0 &&  true === self::$enableLoginPost)){
	     $stateMachineUser->apply('login');
	  }else{
		   $stateMachineUser->apply('logout');
	  }
	  
	  
	  
	  if(true===$this->isInstalled($stateMachine)){
						$stateMachine
							   ->apply('run', [			      
								   'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,			
							   ]);
	  }elseif(true===$this->isPrepared($stateMachine)){
						$stateMachine
							   ->apply('prepare', [			      
								   'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : false,			
							   ]);
	  }elseif($this->isLoading($stateMachine)){
	     $stateMachine->apply('load', [
			       'wsdir' => (isset($this->config->wsdir)) ? $this->config->wsdir : \webfan\hps\patch\Fs::getRootDir($_SERVER['DOCUMENT_ROOT']).\DIRECTORY_SEPARATOR.'frdlweb'.\DIRECTORY_SEPARATOR,
			 ]);
	  }else{
		 //  $stateMachine->apply('uninstalled');
	  }	  
	  

	   $Event = new \webfan\hps\Event('Shield.initialized');	
	   $Event->setArgument('Shield', $this);	  
	   $this->getEmitter()->emit($Event->getName(), $Event);
	  
   return $this;
  }
	
	

	

  

	
  public function _isAdmin(\Finite\StateMachine\StateMachine $stateMachine = null){
    if(null === $stateMachine){  
	 $stateMachine = $this->container->get('webfan.app.fsm');
	}  
	 
   return call_user_func_array([$this, 'isAdmin'], 
							   [$stateMachine, 
								'POST'===$_SERVER['REQUEST_METHOD'] && isset($_POST['op_login']) && self::$loginAttempts<=0, 
								(isset($_POST['username'])) ? $_POST['username'] : null, 
								(isset($_POST['password'])) ? $_POST['password'] : null ]);
  }
	
	
  public function isAdmin(\Finite\StateMachine\StateMachine $stateMachine = null, $login = null, $username = null, $password = null, $lockUri = null){
	  
		$this->initialize();																													
																															
																															
	if(null === $username){  
	  $username = (isset($_POST['username']) && !empty($_POST['username'])) ? $_POST['username'] : false;
	}
	  
    if(false === $username || empty($username)){
       unset($username);
	}
	  
	if(null === $password){  
	  $password = (isset($_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : false;
	}
	  
    if(false === $password || empty($password)){
       unset($password);
	}
	  

	 if(null === $stateMachine){  
	 $stateMachine = $this->container->get('webfan.app.fsm');
	}  
	  

	 if(!is_bool($login)){
		 $login = (self::$loginAttempts <=1 && 'POST'===$_SERVER['REQUEST_METHOD']) ? true : false;
	 }
	  

	//  if(!$this->session_started()){	
	//	  session_start(); 
	//  }
	  
	  
	 $StubConfig = $this->getStubConfig();

	//  if(true === $login && 'POST'===$_SERVER['REQUEST_METHOD'] && isset($_POST['op_login']) ){
	   if(  true === self::$enableLoginPost		   
          &&  true === $login 
		  && isset($username) && is_string($username)  
		  && isset($password)  && is_string($password)  ){
		 //todo bruteforce protection
		   self::$loginAttempts++;
		  
		   /*
		   $this->emitter->emit('isAdmin::POST', [$_POST, $this]);
		  */
		
		   $Event = new \webfan\hps\Event('isAdmin::POST::try');	
		   $Event->setArgument('Shield', $this);
		   $this->getEmitter()->emit($Event->getName(), $Event);  
		  
		    $admins = [];
		  
	             if(isset($this->config->ADMIN_EMAIL) && !empty($this->config->ADMIN_EMAIL)
                   && isset($this->config->ADMIN_EMAIL_CONFIRMED) 
				   && true === $this->config->ADMIN_EMAIL_CONFIRMED
				   ){
				        $admins[]=$this->config->ADMIN_EMAIL;
				   }elseif(isset($this->config->ADMIN_EMAIL) && !empty($this->config->ADMIN_EMAIL)
                       && isset($this->config->ADMIN_EMAIL_CONFIRMED) && true !== $this->config->ADMIN_EMAIL_CONFIRMED ){
					 $admins[]=$this->config->ADMIN_EMAIL;
				//	 $admins[]='admin';
				//	 $admins[]='root';
					 $admins[]= get_current_user();
				 }else{
					 $admins[]= get_current_user();
               //      $admins[]='admin';
               //      $admins[]='root';
				 }
		  

	   if(   isset($username) 
		 && in_array($username, $admins) 
		 && isset($password) 
		 && true === $this->container->get('csrf-token-service')->validateRequest($lockUri)  
		 && (
			     (isset($this->config['hashed_password']) && true===password_verify($password, $this->config['hashed_password']) )
			 ||  (isset($StubConfig['hashed_password']) && true===password_verify($password, $StubConfig['hashed_password']) )
			// ||  true===password_verify($_POST['password'], $this->config['imports']['frdl.config.stub.php']['hashed_password'])
		    )
		
		){
		  $_SESSION[self::SESSIONKEY]['isAdmin'] = true;
		  $_SESSION[self::SESSIONKEY]['user'] = [
			   'username' => $username,
			   'email' => $this->config->ADMIN_EMAIL,
               'email_confirmed_status' => $this->config->ADMIN_EMAIL_CONFIRMED,
			   'sec_fingerprint' => $this->fingerprint(),
           ];
		   $this->getEmitter()->emit('login.isAdmin::POST', []);
	     }else{
		    
		     $this->getEmitter()->emit('login.failed', ['as'=>$username,
												  'REMOTE_ADDR'=>$_SERVER['REMOTE_ADDR'],
												  'FORWARDED_FOR'=> (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : false ]); 
		     
	    }
	  
	  }	   
		   
		   
	  return $this->_logedInSession();
  }	
	
  protected function _logedInSession(){
	  $check1 = (isset($_SESSION[self::SESSIONKEY]['isAdmin']) && true===$_SESSION[self::SESSIONKEY]['isAdmin']) ?true:false;
	  $check2 = (isset($_SESSION[self::SESSIONKEY]['user']) && isset($_SESSION[self::SESSIONKEY]['user']['sec_fingerprint'])
				    && $_SESSION[self::SESSIONKEY]['user']['sec_fingerprint'] === $this->fingerprint()
                 ) ?true:false;
	  
	 $valid =  true===$check1 && true === $check2 ? true : false;
	  
	  if(true !== $valid){
		// unset( $_SESSION[self::SESSIONKEY]['isAdmin']);
	//	// unset($_SESSION[self::SESSIONKEY]['user']);  
		//  if(isset($_SESSION[self::SESSIONKEY]['user'])){			  
		//	unset($_SESSION[self::SESSIONKEY]['user']);  
		//  }
		//  if(isset($_SESSION[self::SESSIONKEY]['isAdmin'])){			  
		//	unset($_SESSION[self::SESSIONKEY]['isAdmin']);  
		 //// }
		// unset($_SESSION[self::SESSIONKEY]);  
		  if(isset($_SESSION[self::SESSIONKEY]['isAdmin'])){
			$_SESSION[self::SESSIONKEY]['isAdmin'] =  false;  
		  }
		  
          if(isset($_SESSION[self::SESSIONKEY]['user'])){
			  $_SESSION[self::SESSIONKEY]['user'] = [
				  'sec_fingerprint' => $this->fingerprint(),
              ];
		  }
	  }

	  return $valid;
  }
	

  protected function fingerprint(){
	  $xIp = (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '*ZERO*';
	  $Ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '*ZERO*'; 
	  $userAgent = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '*ZERO*'; 
	return sha1($userAgent.$xIp.$Ip);  
  }
	
  public function isInstalled(\Finite\StateMachine\StateMachine $stateMachine = null){
	  
	if(null === $stateMachine){  
	 $stateMachine = $this->container->get('webfan.app.fsm');
	}  
	  
	if(!isset($this->config->COMPOSER_PATH))return false;  
	if(!isset($this->config->NODE_PATH))return false;  
	if(!isset($this->config->NPM_PATH))return false;  
	if(!isset($this->config->FRDLJS_PATH))return false;  
	//if(!isset($this->config->wsdir) || !is_dir($this->config->wsdir) )return false;
	  if(!isset($this->config->wsdir) )return false;
	if(!file_exists( rtrim($this->config->wsdir, \DIRECTORY_SEPARATOR.' ').\DIRECTORY_SEPARATOR.self::WORKSPACES_FILENAME) )return false;
	if(!file_exists( rtrim($this->config->wsdir, \DIRECTORY_SEPARATOR.' ').\DIRECTORY_SEPARATOR.self::CONFIG_FILENAME) )return false;	  
	if(!file_exists( rtrim($this->config->wsdir, \DIRECTORY_SEPARATOR.' ').\DIRECTORY_SEPARATOR.self::VERSION_FILENAME) )return false;	  	
	  

  if($this->session_started()){	  
	 $isBashfile = false;
	  
 		  if(!isset($_SESSION[$SESSIONKEY]['breaker']['BASH_FILENAME'])){		
			  $_SESSION[$SESSIONKEY]['breaker']['BASH_FILENAME'] = [
			      'time' => 0,
				  'succes' => file_exists( rtrim($this->config->wsdir, \DIRECTORY_SEPARATOR.' ').\DIRECTORY_SEPARATOR.self::BASH_FILENAME)
              ];	
		  }	elseif(isset($_SESSION[$SESSIONKEY]['breaker']['BASH_FILENAME']['succes']) && true===$_SESSION[$SESSIONKEY]['breaker']['BASH_FILENAME']['succes'] ) {
			   $isBashfile = file_exists( rtrim($this->config->wsdir, \DIRECTORY_SEPARATOR.' ').\DIRECTORY_SEPARATOR.self::BASH_FILENAME);
		  }

	     if(true!== $isBashfile && true !== $_SESSION[$SESSIONKEY]['breaker']['BASH_FILENAME']['succes'] 
			&& (0===$_SESSION[$SESSIONKEY]['breaker']['BASH_FILENAME']['time'] || $_SESSION[$SESSIONKEY]['breaker']['BASH_FILENAME']['time'] < time() - 60  )
			&& true===$this->_isAdmin($this->container->get('webfan.app.fsm'))
			){
				$_SESSION[$SESSIONKEY]['breaker']['BASH_FILENAME']['time'] = time();																															
				$isBashfile = $this->installBashFile( rtrim($this->config->wsdir, \DIRECTORY_SEPARATOR.' ').\DIRECTORY_SEPARATOR.self::BASH_FILENAME );
			    $_SESSION[$SESSIONKEY]['breaker']['BASH_FILENAME']['succes'] = $isBashfile;
		 }
	  
    if(true!== $isBashfile)return false;
  }
	  
    if(!file_exists( rtrim($this->config->wsdir, \DIRECTORY_SEPARATOR.' ').\DIRECTORY_SEPARATOR.self::BASH_FILENAME) )return false;  
				
	  

	return true;  
  }
	
	protected function installBashFile(string $bashfile = null):bool{				
		if(null===$bashfile){
		  $bashfile= rtrim($this->config->wsdir, \DIRECTORY_SEPARATOR.' ').\DIRECTORY_SEPARATOR.self::BASH_FILENAME;	
		}elseif($bashfile !== rtrim($this->config->wsdir, \DIRECTORY_SEPARATOR.' ').\DIRECTORY_SEPARATOR.self::BASH_FILENAME){
	          throw new \Exception('BASH file SHOULD be installed into this installers workspace directory in '.__METHOD__);
            return false;				
		}
		
		if (file_exists($bashfile)) {	
			return true;
		}
		
		if(dirname($bashfile) === $_SERVER['DOCUMENT_ROOT']){
	          throw new \Exception('BASH file MUST NOT be public in '.__METHOD__);
            return false;			
		}
		
			if(!is_dir(dirname($bashfile))){	
				mkdir(dirname($bashfile), 0755, true);		
			}
			chmod(dirname($bashfile), 0755);
   
	if (!file_exists($bashfile)) {		
        $bashrc = <<<EOF
shopt -s expand_aliases

# man output formatting
export MAN_KEEP_FORMATTING=1
export PATH=\$PATH:/usr/games
export TERM="xterm-256" #force colors for dircolors
alias grep="grep --color=always"

if [ -x /usr/bin/dircolors ]; then
    #Nice colors
    eval "`dircolors -b`"
    alias ls="ls --color=always"
fi
EOF;
        $f = fopen($bashfile, 'w');
        fwrite($f, $bashrc);
        fclose($f);  
		
		chmod($bashfile, 0755);
	}
		
	  return file_exists($bashfile);
	}	
	


  public function isPrepared(\Finite\StateMachine\StateMachine $stateMachine = null){
	  
	if(null === $stateMachine){  
	 $stateMachine = $this->container->get('webfan.app.fsm');
	}  
	  
	if(!isset($this->config->COMPOSER_PATH))return false;  
	if(!isset($this->config->NODE_PATH))return false;  
	if(!isset($this->config->NPM_PATH))return false;  
	if(!isset($this->config->FRDLJS_PATH))return false; 
//	if(!isset($this->config->wsdir) || !is_dir($this->config->wsdir) )return false;
	  if(!isset($this->config->wsdir) )return false;
	return true;  
  }
		
  public function isLoading(\Finite\StateMachine\StateMachine $stateMachine = null){
	  
	if(null === $stateMachine){  
	 $stateMachine = $this->container->get('webfan.app.fsm');
	}  
	  
    return isset($this->config->wsdir) && is_dir($this->config->wsdir);
  }	
	
  public function index($uri = null){
	  $this->uri = (is_string($uri)) ? $uri : $_SERVER['REQUEST_URI'];

			//  if (!headers_sent()) {			 
			//	  header('Connection: close');			
			//  }		
	        $this->initialize();


	    $Event = new \webfan\hps\Event('kernel.Shield.send_response');	
		$Event->setArgument('Shield', $this);	
		$Event->setArgument('container', $this->getContainer());  
		$this->getEmitter()->emit($Event->getName(), $Event); 
	  

	  switch($this->uri){
		  case '/proxy/' : 
			    $this->proxy();
			  break;		
		  case '/dashboard/' : 
			    $this->dashboard();
			  break;		
		  case '/rpc/' : 
			    $this->rpc();
			  break;			  
		  case '/' :		  		  
		  case '/login/' : 	  
		  case '/index.php' :
		    default : 		

			  if('/login/'===$this->uri){
				   self::$enableLoginPost = true;
	              // $success = $this->initialize()->isAdmin($this->container->get('webfan.app.fsm'), true, $_POST['username'], $_POST['password'], '/login/');
				   $success = $this->isAdmin($this->getContainer()->get('webfan.app.fsm'), true, $_POST['username'], $_POST['password'], '/login/');
				   if(true===$success){
                         die();  
				   }else{
					  die('Login failed');   
				   }
			  }else{
				  self::$enableLoginPost = false;  
			  }
			  $Template = new IndexShield($this);
			  $Template($this->config);
		   break;	  
			  
	  }
  }		
	
	


   protected function proxy(){
	   if(!$this->initialize()->isAdmin($this->getContainer()->get('webfan.app.fsm'), false)){
		   die('You are not logged in as root!');
		   exit;
	   }
	   
	   
   //   $TestProxy = new \Webfan\App\TestProxy('blue', '/testprojekt/');
  //    $TestProxy->handle();   
   }



	
	public function rpc(){	

		$this->getEmitter()->emit('before.rpc', ['container'=>$this->getContainer()]); 
		
   //     header_remove(); 
		header('Content-Type: application/json');
		$this->stop( $this->getContainer()->get('webfan.app.rpc.server')->run(file_get_contents('php://input')) );
	}
	
	public function pc($method, $params){	
		$this->getEmitter()->emit('before.rpc', ['container'=>$this->getContainer()]); 
		
        $client = $this->getContainer()->get('json-rpc.encoder');

		$client->query($this->_pci++, $method, $params);
		$message = $client->encode();
		$result = json_decode($this->getContainer()->get('webfan.app.rpc.server')->run($message));
		return $result->result;
		
          // $client->query(1, 'add', array(1, 2));
          // $message = $client->encode();
          // message: {"jsonrpc":"2.0","method":"add","params":[1,2],"id":1}
	}
	
	
	
	public function stop($r = null){       
	    if('cli' === strtolower(substr(\PHP_SAPI, 0, strlen('cli')))){
		  return (!is_int($r)) ? exit : exit($r);	
		}else{
			 /*	
			$Event = new \webfan\hps\Event('kernel.Shield.send_response');			
			$Event->setArgument('Shield', $this);			
			$Event->setArgument('container', $this->container);  	
			$Event->setArgument('content', $r);			
			$this->getEmitter()->emit($Event->getName(), $Event);  
			*/

			return (null === $r) ? die() : die($r);	
		}
	}
	

	
	
    public function getFiniteState()
    {
        return $this->state;
    }
    public function setFiniteState($state)
    {
        $this->state = $state;
    }
	
	
   
    public function setInstallStatus($installStatus)
    {
        $this->installStatus = $installStatus;
    }
    public function getInstallStatus()
    {
        return $this->installStatus;
    }	
		
	
    public function setUpdateStatus($updateStatus)
    {
        $this->updateStatus = $updateStatus;
    }
    public function getUpdateStatus()
    {
        return $this->updateStatus;
    }	
	
	
	

	
	
	
	
    public function setAppStatus($appStatus)
    {
        $this->appStatus = $appStatus;
    }
    public function getAppStatus()
    {
        return $this->appStatus;
    }
	
	
    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;
    }
    public function getUserStatus()
    {
        return $this->userStatus;
    }
	
	
	
	
    public function setSetupStatus($setupStatus)
    {
        $this->setupStatus = $setupStatus;
    }
    public function getSetupStatus()
    {
        return $this->setupStatus;
    }
	
	
	
    public function setJobStatus($jobStatus)
    {
        $this->jobStatus = $jobStatus;
    }
    public function getJobStatus()
    {
        return $this->jobStatus;
    }
			
	
	
	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Webfan/App/ShieldServiceProvider.php" ; name="class Webfan\App\ShieldServiceProvider"
Content-Type: application/x-httpd-php

<?php 

namespace Webfan\App;

class ShieldServiceProvider extends \frdl\ServiceProvider
{
	protected $AppAhield;
	public function __construct(Shield $AppAhield){
		$this->AppAhield=$AppAhield;
	}
	
	
	public function __invoke(\Psr\Container\ContainerInterface $container) : void{ 	
		
     $container->set( 'webfan.app.shield.$::class', get_class($this->AppAhield));	
		
   $container->factory(\frdl\webfan\App::class, static function(\UMA\DIC\Container $c) {
      return \frdl\webfan\App::God(false);
   });		

   $container->factory('global',static function(\UMA\DIC\Container $c) {
      return $c->get(\frdl\webfan\App::class);
   });		
		
   $stub = $this->AppAhield->getStub(); 	  
   $container->factory('webfan.app.shield',static function(\UMA\DIC\Container $c) use($stub) {
	   $class = $c->get( 'webfan.app.shield.$::class');
	   return call_user_func_array($class.'::getInstance', [$stub, $c]);
    //   return Shield::getInstance($stub, $c);
   });	  	  
	  
	  /*
   $this->container->set( 'webfan.app.shield', (isset($_SESSION[self::SESSIONKEY]['webfan.app.shield']))
		  //? unserialize($_SESSION[self::SESSIONKEY]['webfan.app.shield']) 
		    ? Shield::getInstance() 				 
		  :  Shield::getInstance());
	  */
	  
	  
	  
	  
   $container->factory( __CLASS__,static function(\UMA\DIC\Container $c) {	   
      return  $c->get( 'webfan.app.shield');
   });
// $mutex = new \malkusch\lock\mutex\FlockMutex(fopen($this->getLockFile($this), "r"));
   $container->factory('webfan.app.mutex.lock.stub',static function(\UMA\DIC\Container $c) {
       return new \malkusch\lock\mutex\FlockMutex(fopen($c->get( 'webfan.app.shield')->getLockFile($c->get( 'webfan.app.shield')), "r"));
   });	  
	  
  $container->set('csrf-token-service',static function(\UMA\DIC\Container $c) {
      return $c->get(\frdl\security\csrf\CsrfToken::class);
   });	

  $container->set(\frdl\security\csrf\CsrfToken::class,static function(\UMA\DIC\Container $c) {
	 //   if(!$c->get(__CLASS__)->session_started()){
	  //     session_start();  
     //    }		
	  
      return new \frdl\security\csrf\CsrfToken($_POST, $_SESSION, $_SERVER);
   });		
		
  $container->set( 'webfan.app.fsm',static function(\UMA\DIC\Container $c) {
      return new \Finite\StateMachine\StateMachine($c->get(__CLASS__));
   });
	  
   $container->set( 'webfan.app.fsm.user',static function(\UMA\DIC\Container $c) {
      return new \Finite\StateMachine\StateMachine($c->get(__CLASS__));
   });
	  
   $container->set( 'webfan.app.shield.user',static function(\UMA\DIC\Container $c) {
	  $class = get_class($c->get( 'webfan.app.shield'));
      return (new $class( $c->get( 'webfan.app.shield')->getContainer(), $c->get( 'webfan.app.shield')->getStub(), false))
		    ->setConfig($c->get( 'webfan.app.shield')->getConfig(), false) 
		  ;
	  // return unserialize(serialize($c->get( 'webfan.app.shield')));
   });
	  
	  
	  
   $container->factory('.rand.str',static function(\UMA\DIC\Container $c){
	   $class = $c->get( 'webfan.app.shield.$::class');
	   return call_user_func_array($class.'::mxGetARandomString', [32, 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789']);
    });	  
	  
   $container->factory( 'emitter',static function(\UMA\DIC\Container $c) {
      return $c->get( \frdl\Flow\EventEmitter::class );
   });
	  	  		
	  
   $container->set( \frdl\Flow\EventEmitter::class,static function(\UMA\DIC\Container $c) {
      return new \frdl\Flow\EventEmitter();
   });
		
   $container->factory( 'finder',static function(\UMA\DIC\Container $c) {
      return new \Symfony\Component\Finder\Finder();
   });
		
   $container->factory( 'json-rpc.encoder',static function(\UMA\DIC\Container $c) {
      return new \Datto\JsonRpc\Client();
   });
		
		
   $container->set( 'floodprotection.login.admin',static function(\UMA\DIC\Container $c) {
      return new \frdl\security\floodprotection\FloodProtection('isAdmin::POST', 6, 90);		
   });		
		
		
  }
	
	
	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Webfan/App/IndexShield.php" ; name="class Webfan\App\IndexShield"
Content-Type: application/x-httpd-php

<?php 

namespace Webfan\App;

use frdl\security\csrf\CsrfToken;

class IndexShield 
{
	

	
	protected $AppShield;
	public function __construct(Shield &$AppShield){
		$this->AppShield=$AppShield;
	}
	
	public function __invoke(/*\webfan\hps\patch\ngScope*/  $context){
		
	//if(!$this->AppShield->session_started()){
	//	session_start();
	//}
		$this->AppShield->initialize();
		
?><!DOCTYPE html>
<html>
<head>
<title>Webfan Setup</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css; charset=UTF-8">
<meta http-equiv="Content-Script-Type" content="text/javascript; charset=UTF-8">	
<meta name="application-name" content="Webfan" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="lightblue" />
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta name="generator" content="https://webfan.de">	
<!-- <link rel="manifest" type="application/manifest+json" href="/manifest.webapp" /> -->
<link rel="icon" type="image/x-icon" href="https://<?php echo (isset($context['workspace'])) ? $context['workspace'] : 'frdl.webfan.de'  ?>/favicon.ico" />
<link rel="shortcut icon" href="https://<?php echo (isset($context['workspace'])) ? $context['workspace'] : 'frdl.webfan.de'  ?>/favicon.ico" type="image/ico">
<script>
 window.name = 'NG_DEFER_BOOTSTRAP!Webfan Setup';		
</script>
<style type="text/css">
*:not([data-text]) {
 margin: 0.1em; margin-left: 0.1em; padding-right: 0.1em; vertical-align:top;
}
[ng:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], [ng-cloak], .ng-cloak, .x-ng-cloak { display: none !important; }
	
[webfan-fadeout].img-precloak, [webfan-fadeout].with-ico { background : url(https://cdn.webfan.de/ajax-loader_2.gif) no-repeat 25% 50%; } 	
	
body {

    background-color: #F9F8F8;
    margin: 4px;
    padding:4px;
   
    font-size:1em;

}
a:link { color:#00238a;text-decoration: underline; }
a:visited { color:#00238a;text-decoration: underline; }
a:hover { text-decoration: underline; }
a:active { text-decoration: underline; }
a#forgot {color:#444444;text-decoration:underline;}
a#forgot:hover { text-decoration:underline; color:#0F0F0F; border-color:#666666; }



#logo1 {position:absolute;top:15px;
    font-family: Tahoma, Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: normal;
    width: auto; text-align:left; }

.centered { border: 0;  width: auto; max-width:99%;margin:40px auto; color: black; padding:10px;border:2px solid #b1c5de; text-align:right;overflow:auto;
 background: url(https://<?php echo (isset($context['workspace'])) ? $context['workspace'] : 'frdl.webfan.de'  ?>/bilder/domainundhomepagespeicher/produkte/kurzbeschreibung/24.251.251THP.produktbild_artikelbeschreibung.jpg) no-repeat;
}
.aligncenter {text-align:center;}
.content {
	width:auto;text-align:left;float:center;

}



.progress-bar-info {
  background-color : blue;	
}
.progress-bar-success {
  background-color : green;	
}
.progress-bar-danger {
  background-color : red;	
}
.progress-bar-warning {
  background-color : yellow;	
}
</style>

<link href="https://<?php echo (isset($context['workspace'])) ? $context['workspace'] : 'frdl.webfan.de'  ?>/cdn/application/<?php 
			echo $this->AppShield->getCacheBustKey();
?>/node_modules/bootstrap-4/css/bootstrap-min.css" type="text/css" rel="stylesheet">	

	
	
<script type="text/javascript" src="https://frdl.webfan.de/cdn/frdl/flow/components/frdl/intent/webintents.js"></script>	


<script>

(function(){
   var OldName =window.name;
	
//	Object.freeze(window.name);
	if(window.intent)window.__frdl_intent=window.intent;
	
	window.addEventListener('message', function(event){	   
		window.name = OldName;
		if(window.intent)window.__frdl_intent=window.intent;
	  setTimeout(function(){  	
		  window.name = OldName;
		  process.ready(function(){			
		  	
			
						if(window.intent)window.__frdl_intent=window.intent;
			
			setTimeout(function(){  
					window.name = OldName;	 
					if(window.intent)window.__frdl_intent=window.intent;	
						
				setTimeout(function(){  
					window.name = OldName;	 
					if(window.intent)window.__frdl_intent=window.intent;	
						setTimeout(function(){  					
							window.name = OldName;	 					
							if(window.intent)window.__frdl_intent=window.intent;			
						},3000);
				},2000);
			},8);
		});	
	  },1700);
	});
	
}());
</script>
	
	
<script type="text/javascript" src="https://<?php echo (isset($context['workspace'])) ? $context['workspace'] : 'frdl.webfan.de'  ?>/cdn/application/<?php 
			echo $this->AppShield->getCacheBustKey();
?>/frdlweb.js"></script>	
	
	
	
	<!-- ?callback=frdl.inX.addDict -->
<meta name="frdl.inX.dictonary-file" content="__PROTOCOL__//__HOST__/software-center/modules-api/locales/__LANG__/dict.jsonp">
<meta name="frdl.inX.dictonary-file" content="__PROTOCOL__//__HOST__/software-center/modules-api/locales/frdlweb/installer/__LANG__/dict.jsonp">	
<?php
 $this->AppShield->getContainer()->get('csrf-token-service')->insertHeaderTokenHtml('/login/', true);	
?>	
</head>	
<body>	
	
	<div style="position:fixed;font-style:italic;bottom:0px;">
	  <small>
		  <a target="_installer" href="https://<?php echo (isset($context['workspace'])) ? $context['workspace'] : 'domainundhomepagespeicher.webfan.de'  ?>/install/">
		  <i>powered by</i> webfan@frdl
		  </a>
		</small>
	</div>	
	
	
<div oc-lazy-load="['frdlweb.install', 'ui-notification', 'frdl-ui-progressbar']">	


	
<div ng-controller="WizCtrl">	

	<frdl-progressbar></frdl-progressbar>	
	
	
<div style="position:fixed;float:top;padding:4px;padding-top:2px;margin:12px;z-Index:999;top:1px;left:1px;" ng-cloak>
<hamburger-button ng-cloak>	
<ul class="menu-list"  ng-cloak>	
	<li class="menu-item"><a ui-sref="install({})"  class="btn btn-success" ui-sref-active="active">Dashboard</a></li> 
	
		 <li class="menu-item">
			 <a class="btn btn-success" href="https://<?php echo (isset($context['workspace'])) ? $context['workspace'] : 'domainundhomepagespeicher.webfan.de'  ?>/install/" target="_installer">Installer Download</a> 
	</li> 
	      
			<!-- 	  
				<li class="menu-item">  
			       <a ng-click="startWizard()">Start Setup Wizard...</a>				  
				</li>

				  -->
				<li ng-show="appStates['webfan.app.fsm']=='installed'" class="menu-item"><a ui-sref="project({})" ui-sref-active="active">Project</a></li>
	
				<li  class="menu-item"><a ui-sref="system({})" ui-sref-active="active">System</a></li>
	            <li  class="menu-item"><a href="https://packages.frdl.de">Packages</a></li>
				<!--  <li><a ui-sref="devTools({})" ui-sref-active="active">devTools</a></li>				   -->
				  
			  <li ng-show="project" class="menu-item"><a ui-sref-active="active" ui-sref="project.composer({dir:project.__DIR__})">Composer</a></li>
	          <li ng-show="!project" class="menu-item"><a ui-sref-active="active" ui-sref="project.composer({})">Composer</a></li>
	 
	
	
	     <li class="menu-item"><a ui-sref="hosting({})"  class="btn btn-success" ui-sref-active="active">Webhosting Account</a></li>  
</ul>
	
			
</hamburger-button>		
</div>
	

	
		


<div class="aligncenter">
<div class="centered">


	
<div class="d-block f-top" ng-include="urls.tpl_top" ng-cloak></div>

	
	
<div class="content">
 
 <span webfan-fadeout="3000" frdl-id="loading-icon" class="with-ico" style="width:32px;height:32px;">&nbsp;&nbsp;&nbsp;</span>	
	
		
<div class="d-rel-inline-block f-top" ui-view="topView" ng-cloak></div>				 
<div class="d-rel-inline-block f-top" ui-view="startView" ng-cloak></div>
								 
				 
<div class="d-rel-inline-block f-center" ui-view="centerView" ng-cloak>
  <a ng-show="!$state.current || $state.current.name==''" ui-sref="install({})"  class="btn btn-success" ui-sref-active="active">Dashboard</a>
</div>				 
				 
		
	
<div class="d-rel-inline-block" ui-view="projectStartView"></div>
		
		
	

		
		
<div class="d-block f-bottom" ui-view="terminalView"  ng-cloak>
 
 <div ng-include="urls.tpl_terminal_buttons" ng-cloak></div>	
 <div ng-include="urls.terminal" ng-cloak></div>	
	<small frdl-hint="terminal-login-how-to"><i>The terminal password is the same as your <a ui-sref="install({})" ui-sref-active="active">admin/root password</a>!</i></small>
 <div ng-include="urls.tpl_terminal_buttons" ng-cloak></div>	
</div>	
	
	
<div class="d-block f-bottom" ui-view="messagesView"  ng-cloak>
 <!-- <div ng-include="urls.tpl_messages" ng-cloak></div>	-->
 
	<ui-notification-log log-template="{{urls.tpl_messages}}"></ui-notification-log>
 
</div>		
	
	
	
<div class="d-block f-bottom" ui-view="bottomView">			
		
	<strong webfan-fadeout="100" class="with-ico">Welcome to the Frdlweb CMS Installer...!</strong>	
	<noscript><error>You MUST enable javascript in your browser to use this site!</error></noscript>	
		
</div>	
	
	
<script>
window.addEventListener('DOMContentLoaded', function(){	 	



var weiter = false;
	
process.addReadyCheck(function(){
	if('undefined'===typeof require)return false;
	 var Webfan = require('@frdl/webfan');
	 return weiter === true && 'undefined'!==typeof Webfan.hps && 'undefined'!==typeof Webfan.hps.terminal  && 'undefined'!==typeof Webfan.hps.terminal.settings; 
});
	

	 
<?php		 
//if($this->AppShield->isAutoupdate() && filemtime($this->AppShield->getStub()->location) > time() - 30*60){
if($this->AppShield->isAutoupdate() || filemtime($this->AppShield->getStub()->location) > time() - 30*60){	 
?>	
process.once('ready:angularjs:root', function(){	
  require.config({
    urlArgs: "bust=<?php
	  echo $this->AppShield->getCacheBustKey();
	  ?>"
  });	
});
<?php
}//if($this->AppShield->isAutoupdate()){
?>		
process.once('ready:angularjs:root', function(){	
	process.nextTick(function(){	
		weiter=true;
	});	
});	
	
	
	
process.once('ready:angularjs:root', function(){	
  var Webfan = require('@frdl/webfan');	
	
  		Webfan.module('hps.terminal.settings', function(plug, req){
		     plug.extend({
				password : true,
				url : '?web=terminal.php',
				storage : true,
				cwd:'' 
			 });
		}); 
	
  require.main.app.root.run(['$rootScope', function($rootScope){
	  $rootScope.$on('terminal.workspace', function (terminal, input, element) {
	     console.debug(arguments);
      });
  }]);	
	
	  	
}); 
	
}); 	
</script>	
	
</div>
</div>


	
</div>
	

	
</div>	
	 
<div style="display:none;" ng-cloak>
 <switch-button></switch-button>	
</div>

	

</div>	
	
	
<intent
    action="composer.package.apply"
    type="text/package-name"
    href="https://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" 
    title="Frdlweb/Webfan Installshield @ <?php echo $_SERVER['SERVER_NAME']; ?>" 
    disposition="new" 
    icon="https://domainundhomepagespeicher.webfan.de/favicon.ico" ></intent>	
	

	
	
		
</body>
</html>
<?php
	}
	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl/security/csrf/CsrfToken.php" ; name="class frdl\security\csrf\CsrfToken"
Content-Type: application/x-httpd-php

<?php  
	
namespace frdl\security\csrf;

use ParagonIE\AntiCSRF\Reusable as BaseTokenClass;
use ParagonIE\AntiCSRF\AntiCSRF;

use ParagonIE\ConstantTime\{
    Base64UrlSafe,
    Binary
};
use Error;

use DateInterval;

class CsrfToken extends BaseTokenClass
{
    public function __construct(
        &$post = null,
        &$session = null,
        &$server = null
    ) {	
       parent::__construct($post, $session, $server);
	   $this->setTokenLifetime(new DateInterval('P2D'));	
	   $this->hmac_ip = false;	
    }
	

    /**
     * Use this to change the configuration settings.
     * Only use this if you know what you are doing.
     *
     * @param array $options
     * @return self
     */
    public function reconfigure(array $options = []): AntiCSRF
    {
        /** @var string $opt */
        /** @var string $val */
        foreach ($options as $opt => $val) {
            switch ($opt) {
                case 'formIndex':
                case 'formToken':
                case 'sessionIndex':
                case 'useNativeSession':
                case 'recycle_after':
                case 'hmac_ip':
                case 'expire_old':
                    /** @psalm-suppress MixedAssignment */
                    $this->$opt = $val;
                    break;
                case 'hashAlgo':
                    if (\in_array($val, \hash_algos(), true)) {
                        $this->hashAlgo = (string) $val;
                    }
                    break;
                case 'lock_type':
                    if (\in_array($val, array('REQUEST_URI','PATH_INFO'), true)) {
                        $this->lock_type = (string) $val;
                    }
                    break;
                case 'tokenLifetime':
                    if ($val instanceof \DateInterval) {
                        $this->tokenLifetime = $val;
                    }
                    break;					
            }
        }
        return $this;
    }	
	
    public function validateRequest($lockToUri = ''): bool
    {
		if(null===$lockTo){
		 $lockTo='';	
		}
	   if(isset($this->server['HTTP_X_CSRF_TOKEN'])){
		  // $tokenData = explode('.', Base64UrlSafe::decode($this->server['HTTP_X_CSRF_TOKEN']), 2);
		   $tokenData = explode('.', $this->server['HTTP_X_CSRF_TOKEN'], 2);
		   if(2 !== count($tokenData)){
			  return false;   
		   }
		  // $this->post[$this->formToken] = Base64UrlSafe::decode($tokenData[1]); 
		  // $this->post[$this->formIndex] = Base64UrlSafe::decode($tokenData[0]); 
		   $this->post[$this->formToken] = $tokenData[1]; 
		   $this->post[$this->formIndex] = $tokenData[0]; 		   
	   }

		//return parent::validateRequest();
		     
		 if ($this->useNativeSession) {
            if (!isset($_SESSION[$this->sessionIndex])) {
                return false;
            }
            /** @var array<string, array<string, mixed>> $sess */
            $sess =& $_SESSION[$this->sessionIndex];
        } else {
            if (!isset($this->session[$this->sessionIndex])) {
                return false;
            }
            /** @var array<string, array<string, mixed>> $sess */
            $sess =& $this->session[$this->sessionIndex];
        }

        if (
            empty($this->post[$this->formIndex]) ||
            empty($this->post[$this->formToken])
        ) {
            // User must transmit a complete index/token pair
            return false;
        }

        // Let's pull the POST data
        /** @var string $index */
        $index = $this->post[$this->formIndex];
        /** @var string $token */
        $token = $this->post[$this->formToken];
        if (!\is_string($index) || !\is_string($token)) {
            return false;
        }

		
		//   print_r($sess); 
		//   print_r($token); 	
		
        if (!isset($sess[$index])) {
            // CSRF Token not found
            return false;
        }

        if (!\is_string($index) || !\is_string($token)) {
            return false;
        }

        // Grab the value stored at $index
        /** @var array<string, mixed> $stored */
        $stored = $sess[$index];

        // We don't need this anymore
        if ($this->deleteToken($sess[$index])) {
            unset($sess[$index]);
        }

        // Which form action="" is this token locked to?
        /** @var string $lockTo */
        $lockTo = (null===$lockToUri)
			  ? $this->server[$this->lock_type]
			  : $lockToUri;
        if (\preg_match('#/$#', $lockTo)) {
            // Trailing slashes are to be ignored
            $lockTo = Binary::safeSubstr(
                $lockTo,
                0,
                Binary::safeStrlen($lockTo) - 1
            );
        }

        if (!\hash_equals($lockTo, (string) $stored['lockTo'])) {
            // Form target did not match the request this token is locked to!
            return false;
        }

        // This is the expected token value
        if ($this->hmac_ip === false) {
            // We just stored it wholesale
            /** @var string $expected */
            $expected = $stored['token'];
        } else {
            // We mixed in the client IP address to generate the output
            /** @var string $expected */
            $expected = Base64UrlSafe::encode(
                \hash_hmac(
                    $this->hashAlgo,
                    isset($this->server['REMOTE_ADDR'])
                        ? (string) $this->server['REMOTE_ADDR']
                        : '127.0.0.1',
                    (string) Base64UrlSafe::decode((string) $stored['token']),
                    true
                )
            );
        }
        return \hash_equals($token, $expected);
	}

    public function insertHeaderToken(string $lockTo = '', bool $echo = true): string
    {
     $token_array = $this->getTokenArray($lockTo);
		  // $token_array = parent::getTokenArray($lockTo);
		
	
       // $ret = Base64UrlSafe::encode($token_array[0].'.'.$token_array[1]);  
		  //$ret = Base64UrlSafe::encode($token_array[$this->formIndex]).'.'.Base64UrlSafe::encode($token_array[$this->formToken]);
		$ret =$token_array[$this->formIndex].'.'.$token_array[$this->formToken];
        if ($echo) {
            echo $ret;
            return '';
        }
        return $ret;
    }	
    /**
     * Retrieve a token array for unit testing endpoints
     *
     * @param string $lockTo
     * @return array
     *
     * @throws \Exception
     * @throws \TypeError
     */
    public function getTokenArray(string $lockTo = ''): array
    {
        if ($this->useNativeSession) {
            if (!isset($_SESSION[$this->sessionIndex])) {
                $_SESSION[$this->sessionIndex] = [];
            }
        } elseif (!isset($this->session[$this->sessionIndex])) {
            $this->session[$this->sessionIndex] = [];
        }

        if (empty($lockTo)) {
            /** @var string $lockTo */
            $lockTo = isset($this->server['REQUEST_URI'])
                ? $this->server['REQUEST_URI']
                : '/';
        }

        if (\preg_match('#/$#', $lockTo)) {
            $lockTo = Binary::safeSubstr($lockTo, 0, Binary::safeStrlen($lockTo) - 1);
        }

        list($index, $token) = $this->generateToken($lockTo);

        if ($this->hmac_ip !== false) {
            // Use HMAC to only allow this particular IP to send this request
            $token = Base64UrlSafe::encode(
                \hash_hmac(
                    $this->hashAlgo,
                    isset($this->server['REMOTE_ADDR'])
                        ? (string) $this->server['REMOTE_ADDR']
                        : '127.0.0.1',
                    (string) Base64UrlSafe::decode($token),
                    true
                )
            );
        }

        return [
            $this->formIndex => $index,
            $this->formToken => $token,
        ];
    }
	
	
    protected function generateToken(string $lockTo = ''): array
    {
        $index = Base64UrlSafe::encode(\random_bytes(18));
        $token = Base64UrlSafe::encode(\random_bytes(33));

		$uri = (!empty($lockTo)) ? $lockTo
			   : ( isset($this->server['REQUEST_URI'])
                ? $this->server['REQUEST_URI']
                : $this->server['SCRIPT_NAME']);
		
        $new = $this->buildBasicToken([
          //  'created' =>\intval(new \DateTime()),
			'created' =>new \DateTime(),
            'uri' => $uri,
            'token' => $token
        ]);

        if (\preg_match('#/$#', $lockTo)) {
            $lockTo = Binary::safeSubstr(
                $lockTo,
                0,
                Binary::safeStrlen($lockTo) - 1
            );
        }

        if ($this->useNativeSession) {
            /** @var array<string, array<string, string|int>> $sess */
            $sess =& $_SESSION[$this->sessionIndex];
        } else {
            /** @var array<string, array<string, string|int>> $sess */
            $sess =& $this->session[$this->sessionIndex];
        }
        $sess[$index] = $new;
        $sess[$index]['lockTo'] = $lockTo;

        $this->recycleTokens();
        return [$index, $token];
    }

    /**
     * Enforce an upper limit on the number of tokens stored in session state
     * by removing the oldest tokens first.
     *
     * @return self
     */
    protected function recycleTokens()
    {
        if (!$this->expire_old) {
            // This is turned off.
            return $this;
        }

        if ($this->useNativeSession) {
            /** @var array<string, array<string, string|int>> $sess */
            $sess =& $_SESSION[$this->sessionIndex];
        } else {
            /** @var array<string, array<string, string|int>> $sess */
            $sess =& $this->session[$this->sessionIndex];
        }
        // Sort by creation time
        \uasort(
            $sess,
            function (array $a, array $b): int {
                return (int) ($a['created'] <=> $b['created']);
            }
        );
        while (\count($sess) > $this->recycle_after) {
            // Let's knock off the oldest one
            \array_shift($sess);
        }
        return $this;
    }
    public function deleteToken(array $token): bool
    {
        if (empty($token['created-date'])) {
            return true;
        }
        if (!($this->tokenLifetime instanceof \DateInterval)) {
            return false;
        }
        $dateTime = (new \DateTime($token['created-date']))->add($this->tokenLifetime);
        $now = new \DateTime();
        return $dateTime >= $now;
    }
	
    public function insertHeaderTokenHtml(string $lockTo = '', bool $echo = true): string
    {
        $token = $this->insertHeaderToken($lockTo, false);
	//	$lockToEncoded = urlencode($lockTo);
		$lockToEncoded = $lockTo;
		
		
		$ret = <<<HTMLCODE
<script>
(function(t, l){
'use strict';

 function d(){
   var meta = document.createElement('meta');
   meta.setAttribute('name', 'CSRF-Token');
   meta.setAttribute('content', t);
   meta.setAttribute('frdl-lockto', l);
   document.head.append(meta);
 }

  if('undefined'!==typeof process && 'function'===process.ready){
   process.ready(function(){
    d();
   });
 }else if('undefined'!==typeof jQuery){
   jQuery(document).ready(function(){
      d();
   });
 }else if('undefined'!==typeof document && 'undefined'===typeof document.body){
   document.addEventListener('DOMContentLoaded', d);
 }else if('complete'===document.readyState && 'undefined'!==typeof document && 'undefined'!==typeof document.head && 'undefined'!==typeof document.body){
      d();
 }else{
   setTimeout(function(){
     d();
   },1750);
 }

}('$token', '$lockToEncoded'));
</script>
HTMLCODE;
		
        if ($echo) {
            echo $ret;
            return '';
        }
        return $ret;
    }		
	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/ParagonIE/AntiCSRF/Reusable.php" ; name="class ParagonIE\AntiCSRF\Reusable"
Content-Type: application/x-httpd-php

<?php 
declare(strict_types=1);

namespace ParagonIE\AntiCSRF;

/**
 * Class Reusable
 *
 * Reusable variant of the AntiCSRF class.
 * Tokens don't expire after a single use. This is dangerous, but allows them
 * to be used in AJAX forms.
 *
 * We will not award any bug bounties for any vulnerabilities found in the
 * Reusable class that are not also present in the main class, as we believe
 * this use-case to be a significant security downgrade.
 *
 * @package ParagonIE\AntiCSRF
 */
class Reusable extends AntiCSRF
{
    /**
     * @var \DateInterval|null
     */
    protected $tokenLifetime = null;

    /**
     * @param \DateInterval $interval
     * @return self
     */
    public function setTokenLifetime(\DateInterval $interval): self
    {
        $this->tokenLifetime = $interval;
        return $this;
    }

    /**
     * For figuring
     *
     * @param array $args
     * @return array
     */
    protected function buildBasicToken(array $args = []): array
    {
        $args['created-date'] = (new \DateTime())->format(\DateTime::ATOM);
        return $args;
    }

    /**
     * Use this to change the configuration settings.
     * Only use this if you know what you are doing.
     *
     * @param array $options
     * @return AntiCSRF
     */
    public function reconfigure(array $options = []): AntiCSRF
    {
        /** @var string $opt */
        /** @var \DateInterval $val */
        foreach ($options as $opt => $val) {
            switch ($opt) {
                case 'tokenLifetime':
                    if ($val instanceof \DateInterval) {
                        $this->tokenLifetime = $val;
                    }
                    break;
            }
        }
        return parent::reconfigure($options);
    }

    /**
     * @param array<string, string> $token
     * @return bool
     */
    public function deleteToken(array $token): bool
    {
        if (empty($token['created-date'])) {
            return true;
        }
        if (!($this->tokenLifetime instanceof \DateInterval)) {
            return false;
        }
        $dateTime = (new \DateTime($token['created-date']))->add($this->tokenLifetime);
        $now = new \DateTime();
        return $dateTime >= $now;
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/ParagonIE/AntiCSRF/AntiCSRF.php" ; name="class ParagonIE\AntiCSRF\AntiCSRF"
Content-Type: application/x-httpd-php

<?php 
declare(strict_types=1);
namespace ParagonIE\AntiCSRF;

use ParagonIE\ConstantTime\{
    Base64UrlSafe,
    Binary
};
use Error;

/**
 * Copyright (c) 2015 - 2018 Paragon Initiative Enterprises <https://paragonie.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *******************************************************************************
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 - 2018 Paragon Initiative Enterprises
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 *
 * If you would like to use this library under different terms, please
 * contact Paragon Initiative Enterprises to inquire about a license exemption.
 */
class AntiCSRF
{
    /**
     * @var string
     */
    protected $formIndex = '_CSRF_INDEX';

    /**
     * @var string
     */
    protected $formToken = '_CSRF_TOKEN';

    /**
     * @var string
     */
    protected $sessionIndex = 'CSRF';

    /**
     * @var string
     */
    protected $hashAlgo = 'sha256';

    /**
     * @var int
     */
    protected $recycle_after = 65535;

    /**
     * @var bool
     */
    protected $hmac_ip = true;

    /**
     * @var bool
     */
    protected $expire_old = false;

    /**
     * @var string
     */
    protected $lock_type = 'REQUEST_URI';

    // Injected; defaults to references to superglobals

    /**
     * @var array
     */
    public $post = [];

    /**
     * @var array
     */
    public $session = [];

    /**
     * @var bool
     */
    public $useNativeSession = false;

    /**
     * @var array
     */
    public $server = [];

    /**
     * NULL is not a valid array type
     *
     * @param array $post
     * @param array $session
     * @param array $server
     * @throws Error
     */
    public function __construct(
        &$post = null,
        &$session = null,
        &$server = null
    ) {
        if (!\is_null($post)) {
            $this->post =& $post;
        } else {
            $this->post =& $_POST;
        }

        if (!\is_null($server)) {
            $this->server =& $server;
        } else {
            $this->server =& $_SERVER;
        }

        if (!\is_null($session)) {
            $this->session =& $session;
        } elseif (isset($_SESSION)) {
            if (\is_array($_SESSION)) {
                $this->session =& $_SESSION;
                $this->useNativeSession = true;
            }
        } else {
            throw new Error('No session available for persistence');
        }
    }

    /**
     * Allow derived classes to inject arguments.
     *
     * @param array $args
     * @return array
     */
    protected function buildBasicToken(array $args = []): array
    {
        return $args;
    }

    /**
     * @param array $token
     * @return bool
     */
    public function deleteToken(array $token): bool
    {
        return true;
    }

    /**
     * Insert a CSRF token to a form
     *
     * @param string $lockTo This CSRF token is only valid for this HTTP request endpoint
     * @param bool $echo if true, echo instead of returning
     * @return string
     * @throws \Exception
     * @throws \TypeError
     */
    public function insertToken(string $lockTo = '', bool $echo = true): string
    {
        $token_array = $this->getTokenArray($lockTo);
        $ret = \implode(
            \array_map(
                function(string $key, string $value): string {
                    return "<!--\n-->".
                        "<input type=\"hidden\"" .
                        " name=\"" . $key . "\"" .
                        " value=\"" . self::noHTML($value) . "\"" .
                        " />";
                },
                \array_keys($token_array),
                $token_array
            )
        );
        if ($echo) {
            echo $ret;
            return '';
        }
        return $ret;
    }

    /**
     * @return string
     */
    public function getSessionIndex(): string
    {
        return $this->sessionIndex;
    }

    /**
     * @return string
     */
    public function getFormIndex(): string
    {
        return $this->formIndex;
    }

    /**
     * @return string
     */
    public function getFormToken(): string
    {
        return $this->formToken;
    }

    /**
     * @return string
     */
    public function getLockType(): string
    {
        return $this->lock_type;
    }

    /**
     * Retrieve a token array for unit testing endpoints
     *
     * @param string $lockTo
     * @return array
     *
     * @throws \Exception
     * @throws \TypeError
     */
    public function getTokenArray(string $lockTo = ''): array
    {
        if ($this->useNativeSession) {
            if (!isset($_SESSION[$this->sessionIndex])) {
                $_SESSION[$this->sessionIndex] = [];
            }
        } elseif (!isset($this->session[$this->sessionIndex])) {
            $this->session[$this->sessionIndex] = [];
        }

        if (empty($lockTo)) {
            /** @var string $lockTo */
            $lockTo = isset($this->server['REQUEST_URI'])
                ? $this->server['REQUEST_URI']
                : '/';
        }

        if (\preg_match('#/$#', $lockTo)) {
            $lockTo = Binary::safeSubstr($lockTo, 0, Binary::safeStrlen($lockTo) - 1);
        }

        list($index, $token) = $this->generateToken($lockTo);

        if ($this->hmac_ip !== false) {
            // Use HMAC to only allow this particular IP to send this request
            $token = Base64UrlSafe::encode(
                \hash_hmac(
                    $this->hashAlgo,
                    isset($this->server['REMOTE_ADDR'])
                        ? (string) $this->server['REMOTE_ADDR']
                        : '127.0.0.1',
                    (string) Base64UrlSafe::decode($token),
                    true
                )
            );
        }

        return [
            $this->formIndex => $index,
            $this->formToken => $token,
        ];
    }


    /**
     * Validate a request based on $this->session and $this->post data
     *
     * @return bool
     * @throws \TypeError
     */
    public function validateRequest(): bool
    {
        if ($this->useNativeSession) {
            if (!isset($_SESSION[$this->sessionIndex])) {
                return false;
            }
            /** @var array<string, array<string, mixed>> $sess */
            $sess =& $_SESSION[$this->sessionIndex];
        } else {
            if (!isset($this->session[$this->sessionIndex])) {
                return false;
            }
            /** @var array<string, array<string, mixed>> $sess */
            $sess =& $this->session[$this->sessionIndex];
        }

        if (
            empty($this->post[$this->formIndex]) ||
            empty($this->post[$this->formToken])
        ) {
            // User must transmit a complete index/token pair
            return false;
        }

        // Let's pull the POST data
        /** @var string $index */
        $index = $this->post[$this->formIndex];
        /** @var string $token */
        $token = $this->post[$this->formToken];
        if (!\is_string($index) || !\is_string($token)) {
            return false;
        }

        if (!isset($sess[$index])) {
            // CSRF Token not found
            return false;
        }

        if (!\is_string($index) || !\is_string($token)) {
            return false;
        }

        // Grab the value stored at $index
        /** @var array<string, mixed> $stored */
        $stored = $sess[$index];

        // We don't need this anymore
        if ($this->deleteToken($sess[$index])) {
            unset($sess[$index]);
        }

        // Which form action="" is this token locked to?
        /** @var string $lockTo */
        $lockTo = $this->server[$this->lock_type];
        if (\preg_match('#/$#', $lockTo)) {
            // Trailing slashes are to be ignored
            $lockTo = Binary::safeSubstr(
                $lockTo,
                0,
                Binary::safeStrlen($lockTo) - 1
            );
        }

        if (!\hash_equals($lockTo, (string) $stored['lockTo'])) {
            // Form target did not match the request this token is locked to!
            return false;
        }

        // This is the expected token value
        if ($this->hmac_ip === false) {
            // We just stored it wholesale
            /** @var string $expected */
            $expected = $stored['token'];
        } else {
            // We mixed in the client IP address to generate the output
            /** @var string $expected */
            $expected = Base64UrlSafe::encode(
                \hash_hmac(
                    $this->hashAlgo,
                    isset($this->server['REMOTE_ADDR'])
                        ? (string) $this->server['REMOTE_ADDR']
                        : '127.0.0.1',
                    (string) Base64UrlSafe::decode((string) $stored['token']),
                    true
                )
            );
        }
        return \hash_equals($token, $expected);
    }

    /**
     * Use this to change the configuration settings.
     * Only use this if you know what you are doing.
     *
     * @param array $options
     * @return self
     */
    public function reconfigure(array $options = []): self
    {
        /** @var string $opt */
        /** @var string $val */
        foreach ($options as $opt => $val) {
            switch ($opt) {
                case 'formIndex':
                case 'formToken':
                case 'sessionIndex':
                case 'useNativeSession':
                case 'recycle_after':
                case 'hmac_ip':
                case 'expire_old':
                    /** @psalm-suppress MixedAssignment */
                    $this->$opt = $val;
                    break;
                case 'hashAlgo':
                    if (\in_array($val, \hash_algos(), true)) {
                        $this->hashAlgo = (string) $val;
                    }
                    break;
                case 'lock_type':
                    if (\in_array($val, array('REQUEST_URI','PATH_INFO'), true)) {
                        $this->lock_type = (string) $val;
                    }
                    break;
            }
        }
        return $this;
    }

    /**
     * Generate, store, and return the index and token
     *
     * @param string $lockTo What URI endpoint this is valid for
     * @return string[]
     * @throws \TypeError
     * @throws \Exception
     */
    protected function generateToken(string $lockTo): array
    {
        $index = Base64UrlSafe::encode(\random_bytes(18));
        $token = Base64UrlSafe::encode(\random_bytes(33));

        $new = $this->buildBasicToken([
            'created' => \intval(
                \date('YmdHis')
            ),
            'uri' => isset($this->server['REQUEST_URI'])
                ? $this->server['REQUEST_URI']
                : $this->server['SCRIPT_NAME'],
            'token' => $token
        ]);

        if (\preg_match('#/$#', $lockTo)) {
            $lockTo = Binary::safeSubstr(
                $lockTo,
                0,
                Binary::safeStrlen($lockTo) - 1
            );
        }

        if ($this->useNativeSession) {
            /** @var array<string, array<string, string|int>> $sess */
            $sess =& $_SESSION[$this->sessionIndex];
        } else {
            /** @var array<string, array<string, string|int>> $sess */
            $sess =& $this->session[$this->sessionIndex];
        }
        $sess[$index] = $new;
        $sess[$index]['lockTo'] = $lockTo;

        $this->recycleTokens();
        return [$index, $token];
    }

    /**
     * Enforce an upper limit on the number of tokens stored in session state
     * by removing the oldest tokens first.
     *
     * @return self
     */
    protected function recycleTokens()
    {
        if (!$this->expire_old) {
            // This is turned off.
            return $this;
        }

        if ($this->useNativeSession) {
            /** @var array<string, array<string, string|int>> $sess */
            $sess =& $_SESSION[$this->sessionIndex];
        } else {
            /** @var array<string, array<string, string|int>> $sess */
            $sess =& $this->session[$this->sessionIndex];
        }
        // Sort by creation time
        \uasort(
            $sess,
            function (array $a, array $b): int {
                return (int) ($a['created'] <=> $b['created']);
            }
        );
        while (\count($sess) > $this->recycle_after) {
            // Let's knock off the oldest one
            \array_shift($sess);
        }
        return $this;
    }

    /**
     * Wrapper for htmlentities()
     *
     * @param string $untrusted
     * @return string
     */
    protected static function noHTML(string $untrusted): string
    {
        return \htmlentities($untrusted, ENT_QUOTES, 'UTF-8');
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdlweb/Thread/ShutdownTasks.php" ; name="class frdlweb\Thread\ShutdownTasks"
Content-Type: application/x-httpd-php

<?php 



namespace frdlweb\Thread;



class ShutdownTasks {
    protected $callbacks; 
    protected static $instance = null; 

    public function __construct() {
        $this->callbacks = [];
		register_shutdown_function(array($this, 'callRegisteredShutdown'));
    }
	
	public function __invoke(){
		return call_user_func_array(array($this,'registerShutdownEvent'), func_get_args() ); 
	}
	
	public function __call($name, $params){
		if('clear'===$name){
			$this->callbacks = [];
			return $this;
		}
		
		throw new \Exception('Unhandled metod in '.__METHOD__.' '.basename(__FILE__).' '.__LINE__);
	}	
	
	public static function __callStatic($name, $params){
		return call_user_func_array(array(self::mutex(),$name), $params ); 
	}
	
	
    public static function mutex() {
             if(null===self::$instance){
			    	self::$instance = new self; 
			 }
		
		return self::$instance;
    }
	
    public function registerShutdownEvent() {
        $callback = func_get_args();
       
        if (empty($callback)) {
            trigger_error('No callback passed to '.__FUNCTION__.' method', E_USER_ERROR);
            return false;
        }
        if (!is_callable($callback[0])) {
            trigger_error('Invalid callback passed to the '.__FUNCTION__.' method', E_USER_ERROR);
            return false;
        }
        $this->callbacks[] = $callback;
		
		if(0===count($this->callbacks)){
				register_shutdown_function(array($this, 'callRegisteredShutdown'));
		}
        return true;
    }
    public function callRegisteredShutdown() {
		while(0<count($this->callbacks)){
		  	$arguments = array_shift($this->callbacks);
			$callback = array_shift($arguments);
		    call_user_func_array($callback, $arguments);
		}
    }

} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Webfan/App/Rpc/RpcServiceProvider.php" ; name="class Webfan\App\Rpc\RpcServiceProvider"
Content-Type: application/x-httpd-php

<?php 

namespace Webfan\App\Rpc;

class RpcServiceProvider extends \frdl\ServiceProvider
{
	
	public function __invoke(\Psr\Container\ContainerInterface $container) : void{

		
	
  $container->set('webfan.app.rpc.auth-shield', function(\UMA\DIC\Container $c) {
    return new \Webfan\App\Rpc\AuthShield($c->get('webfan.app.shield'), $c);
 });		
		
	  
  $container->set( 'webfan.app.rpc.server', function(\UMA\DIC\Container $c) {
	  //\frdlweb\Api\Rpc\Server\EventableServer __construct(ContainerInterface $container, int $batchLimit = null, array $config = null, bool $discovery = true)
         //  $server = new \UMA\JsonRpc\Server($c, 50); 
	        $server = new \frdlweb\Api\Rpc\Server\EventableServer($c, 50, [
				'schemaCacheDir' => $c->get('webfan.app.shield')->getCacheDir(). \DIRECTORY_SEPARATOR . 'json-schema-store' . \DIRECTORY_SEPARATOR,
				  
				
				]);
	       $server->attach('webfan.app.rpc.auth-shield');
	   
	        $server->set('test', \Webfan\App\Rpc\Procedure\test::class);
			$server->set('install.requirements', \Webfan\App\Rpc\Procedure\install_requirements::class);
			$server->set('install.config.get', \Webfan\App\Rpc\Procedure\install_config_get::class);
			$server->set('install.config.set', \Webfan\App\Rpc\Procedure\install_config_set::class);
			$server->set('install.update self', \Webfan\App\Rpc\Procedure\install_update_self::class);
			$server->set('mkdir', \Webfan\App\Rpc\Procedure\MkdirProcedure::class);		
			$server->set('install.feature.composer', \Webfan\App\Rpc\Procedure\install_feature_composer::class);	
			$server->set('install.feature.frdl', \Webfan\App\Rpc\Procedure\install_feature_frdl::class);
			$server->set('install.installer.stub', \Webfan\App\Rpc\Procedure\install_installer_stub::class);
			$server->set('frdl.project.create', \Webfan\App\Rpc\Procedure\frdl_project_create::class);
			$server->set('frdl.projects.get', \Webfan\App\Rpc\Procedure\frdl_projects_get::class);
	        $server->set('frdl.project.read', \Webfan\App\Rpc\Procedure\frdl_project_read::class);
	        $server->set('frdl.compile', \Webfan\App\Rpc\Procedure\frdl_compile::class);
	        $server->set('read', \Webfan\App\Rpc\Procedure\read::class);
	        $server->set('composer.install', \Webfan\App\Rpc\Procedure\composer_install::class);
	        $server->set('composer.update', \Webfan\App\Rpc\Procedure\composer_update::class);
	        $server->set('composer.save', \Webfan\App\Rpc\Procedure\composer_save::class);
			$server->set('composer.projects.get', \Webfan\App\Rpc\Procedure\composer_projects_get::class);
	        $server->set('composer.clearcache', \Webfan\App\Rpc\Procedure\composer_clearcache::class);
	        $server->set('frdl.compile.js', \Webfan\App\Rpc\Procedure\frdl_bundlejs::class);
	  
	
	        $server->set('frdl.module.configs.get', \Webfan\App\Rpc\Procedure\frdl_modules_configs_get::class);
	        $server->set('frdl.config.module.get', \Webfan\App\Rpc\Procedure\frdl_module_config_get::class);
	        $server->set('frdl.config.module.set', \Webfan\App\Rpc\Procedure\frdl_config_module_set::class);
	        $server->set('frdl.config.module.defaults', \Webfan\App\Rpc\Procedure\frdl_config_module_defaults::class);
	  
	        $server->set('update.feature.frdl', \Webfan\App\Rpc\Procedure\update_feature_frdl::class);
	  
	  
	        $server->set('install.feature.node', \Webfan\App\Rpc\Procedure\install_feature_node::class);
	  
	        $server->set('npm.info', \Webfan\App\Rpc\Procedure\npm_info::class);
	  
	  
	        $server->set('frdl.config.module.get.admin', \Webfan\App\Rpc\Procedure\frdl_module_config_get_admin::class);
	        $server->set('frdl.config.module.set.admin', \Webfan\App\Rpc\Procedure\frdl_module_config_set_admin::class);
	  
	  
	  
	        $server->set('admin.navlinks.get', \Webfan\App\Rpc\Procedure\admin_navlinks_get::class);
	        $server->set('admin.navlinks.edit', \Webfan\App\Rpc\Procedure\admin_navlinks_edit::class);
	        $server->set('admin.navlinks.create', \Webfan\App\Rpc\Procedure\admin_navlinks_new::class);
	        $server->set('admin.navlinks.delete', \Webfan\App\Rpc\Procedure\admin_navlinks_delete::class);
	        $server->set('project.named-routes.get', \Webfan\App\Rpc\Procedure\project_get_named_routes::class);
	  
	  
	        $server->set('process.is.running', \Webfan\App\Rpc\Procedure\process_is_running::class);
	        $server->set('pid.is.running', \Webfan\App\Rpc\Procedure\process_is_running::class);
	   return $server;
   });		
				
		
		$container->set(\Webfan\App\Rpc\Procedure\process_is_running::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\process_is_running($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
				
		
		$container->set(\Webfan\App\Rpc\Procedure\test::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\test($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
	
		
		$container->set(\Webfan\App\Rpc\Procedure\install_requirements::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\install_requirements($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
	
		
		
		
		$container->set(\Webfan\App\Rpc\Procedure\install_config_get::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\install_config_get($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
			
		$container->set(\Webfan\App\Rpc\Procedure\install_config_set::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\install_config_set($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
						
		
		
		$container->set(\Webfan\App\Rpc\Procedure\install_update_self::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\install_update_self($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				

	
		$container->set(\Webfan\App\Rpc\Procedure\MkdirProcedure::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\MkdirProcedure($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				

		
	
		$container->set(\Webfan\App\Rpc\Procedure\install_feature_composer::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\install_feature_composer($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
		
		
	
		$container->set(\Webfan\App\Rpc\Procedure\install_installer_stub::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\install_installer_stub($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
		
	
		$container->set(\Webfan\App\Rpc\Procedure\install_feature_frdl::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\install_feature_frdl($c->get('webfan.app.rpc.auth-shield'), $c);				
		});		
		
	
		$container->set(\Webfan\App\Rpc\Procedure\frdl_project_create::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\frdl_project_create($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
		
		$container->set(\Webfan\App\Rpc\Procedure\frdl_projects_get::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\frdl_projects_get($c->get('webfan.app.rpc.auth-shield'), $c);				
		});													
		
		$container->set(\Webfan\App\Rpc\Procedure\frdl_project_read::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\frdl_project_read($c->get('webfan.app.rpc.auth-shield'), $c);				
		});		
		
		
		$container->set(\Webfan\App\Rpc\Procedure\read::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\read($c->get('webfan.app.rpc.auth-shield'), $c);				
		});		
		
		$container->set(\Webfan\App\Rpc\Procedure\composer_install::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\composer_install($c->get('webfan.app.rpc.auth-shield'), $c);				
		});		
			
		$container->set(\Webfan\App\Rpc\Procedure\composer_update::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\composer_update($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
		$container->set(\Webfan\App\Rpc\Procedure\frdl_compile::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\frdl_compile($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
		$container->set(\Webfan\App\Rpc\Procedure\composer_save::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\composer_save($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
		$container->set(\Webfan\App\Rpc\Procedure\composer_projects_get::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\composer_projects_get($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
		$container->set(\Webfan\App\Rpc\Procedure\composer_clearcache::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\composer_clearcache($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
		$container->set(\Webfan\App\Rpc\Procedure\frdl_bundlejs::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\frdl_bundlejs($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
		$container->set(\Webfan\App\Rpc\Procedure\frdl_modules_configs_get::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\frdl_modules_configs_get($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
		$container->set(\Webfan\App\Rpc\Procedure\frdl_module_config_get::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\frdl_module_config_get($c->get('webfan.app.rpc.auth-shield'), $c);				
		});		
		$container->set(\Webfan\App\Rpc\Procedure\frdl_config_module_set::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\frdl_config_module_set($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
		$container->set(\Webfan\App\Rpc\Procedure\frdl_config_module_defaults::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\frdl_config_module_defaults($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
		$container->set(\Webfan\App\Rpc\Procedure\update_feature_frdl::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\update_feature_frdl($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
		$container->set(\Webfan\App\Rpc\Procedure\install_feature_node::class, function(\UMA\DIC\Container $c) { 
					return new \Webfan\App\Rpc\Procedure\install_feature_node($c->get('webfan.app.rpc.auth-shield'), $c);				
		});		
		$container->set(\Webfan\App\Rpc\Procedure\npm_info::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\npm_info($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
		$container->set(\Webfan\App\Rpc\Procedure\frdl_module_config_get_admin::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\frdl_module_config_get_admin($c->get('webfan.app.rpc.auth-shield'), $c);				
		});		
		$container->set(\Webfan\App\Rpc\Procedure\frdl_module_config_set_admin::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\frdl_module_config_set_admin($c->get('webfan.app.rpc.auth-shield'), $c);				
		});				
		$container->set(\Webfan\App\Rpc\Procedure\admin_navlinks_get::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\admin_navlinks_get($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
		$container->set(\Webfan\App\Rpc\Procedure\admin_navlinks_edit::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\admin_navlinks_edit($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
		$container->set(\Webfan\App\Rpc\Procedure\admin_navlinks_new::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\admin_navlinks_new($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
		$container->set(\Webfan\App\Rpc\Procedure\admin_navlinks_delete::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\admin_navlinks_delete($c->get('webfan.app.rpc.auth-shield'), $c);				
		});			
		$container->set(\Webfan\App\Rpc\Procedure\project_get_named_routes::class, function(\UMA\DIC\Container $c) { 
			return new \Webfan\App\Rpc\Procedure\project_get_named_routes($c->get('webfan.app.rpc.auth-shield'), $c);				
		});	
	}
	
	
	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Webfan/App/Rpc/AuthShield.php" ; name="class Webfan\App\Rpc\AuthShield"
Content-Type: application/x-httpd-php

<?php 
//declare(strict_types=1);

namespace Webfan\App\Rpc;



class AuthShield implements \UMA\JsonRpc\Middleware
{

	protected $digData;	
	protected $_SERVER;
	protected $AppShield;
	
	
	
	public function __construct( \Webfan\App\Shield $AppShield, \Psr\Container\ContainerInterface $container = null){
		 $this->AppShield=$AppShield;
		 $this->container=(null!==$container) ? $container : $this->AppShield->getContainer();
	}
	
	
    public function getApp(){
		return $this->AppShield;
	}
    public function getAppShield(){
		return $this->getApp();
	}	
    public function getShield(){
		return $this->getAppShield();
	}


		
    public function __invoke(\UMA\JsonRpc\Request $request, \UMA\JsonRPC\Procedure $next): \UMA\JsonRpc\Response
    {
		
		if(is_callable([$next, 'auth']) && true === $next->auth($request)){
				 return $next($request);
		}elseif(is_callable([$next, 'isAuthenticated']) && true === $next->isAuthenticated($request)){
				 return $next($request);
		}
		
		if(null !== $this->container && 'admin' === $this->container->get('webfan.app.fsm.user')->getCurrentState()->getName() ){
          return $next($request);
		}
		
		return \webfan\hps\Api\Error::unauthorized();
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Webfan/App/Rpc/Procedure/install_config_get.php" ; name="class Webfan\App\Rpc\Procedure\install_config_get"
Content-Type: application/x-httpd-php

<?php 
declare(strict_types=1);

namespace Webfan\App\Rpc\Procedure;




class install_config_get implements \UMA\JsonRpc\Procedure
{
	protected $AuthShield;
	protected $container;
	public function __construct(\Webfan\App\Rpc\AuthShield $AuthShield, \Psr\Container\ContainerInterface $container = null){
		$this->AuthShield = $AuthShield;
		$this->container=(null!==$container) ? $container : $AuthShield->getAppShield()->getContainer();
	}	
	
	
	public function auth(\UMA\JsonRpc\Request $request){
	  return 'admin' ===$this->container->get('webfan.app.fsm.user')->getCurrentState()->getName();	
	}
	
    /**
     * {@inheritdoc}
     */
    public function __invoke(\UMA\JsonRpc\Request $request): \UMA\JsonRpc\Response
    {
        set_time_limit(900);
		$params = $request->params();
		$config = $this->AuthShield->getAppShield()->getConfig()->export();
	//	$config = $this->AuthShield->getAppShield()->config;
		unset($config['hashed_password']);

		try{    
			return new \UMA\JsonRpc\Success($request->id(), $config);
		}catch(\Exception $e){	
			return new \UMA\JsonRpc\Error($request->id(), 'Could get config');
		}
    }


    public function getSpec(): ?\stdClass
    {
        return \json_decode(<<<'JSON'
{
  "$schema": "https://json-schema.org/draft-07/schema#",
  "type": ["null", "array", "object"],
  "properties": {

  },
  "required" : [],
  "additionalProperties": true
}
JSON
        );
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/webfan/hps/patch/Fs.php" ; name="class webfan\hps\patch\Fs"
Content-Type: application/x-httpd-php

<?php 
namespace webfan\hps\patch;


use DirectoryIterator;
use SplFileInfo;


class Fs
{

/*https://www.startutorial.com/articles/view/deployment-script-in-php*/	
 public static function recursiveCopyDir($srcDir, $destDir){
    foreach (new DirectoryIterator($srcDir) as $fileInfo) {
        if ($fileInfo->isDot()) {
            continue;
        }
 
        if (!file_exists($destDir)) {
           shell_exec('mkdir -p '.$destDir);
        }
 
        $copyTo = $destDir . '/' . $fileInfo->getFilename();
 
        copy($fileInfo->getRealPath(), $copyTo);
    }
 }
 
 public static function copyFileToDir($src, $desDir){
    if (!file_exists($desDir)) {
        shell_exec('mkdir -p '.$desDir);
    }
 
    $fileInfo = new SplFileInfo($src);
 
    $copyTo = $desDir . '/' . $fileInfo->getFilename();
 
    copy($fileInfo->getRealPath(), $copyTo);
 }
	
 public static function copy($src, $desDir){
     if(is_dir($src)){
		 self::copy($src, $desDir);
	 }elseif(is_file($src)){
		 self::copyFileToDir($src, $desDir);
	 }
 }
	
 public static function remove($dir){
    shell_exec('rm -rf '.$dir);
 }	
	
 public static function compress($buffer) {
        /* remove comments */
        $buffer = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $buffer);
        /* remove tabs, spaces, newlines, etc. */
        $buffer = str_replace(array("\r\n","\r","\t","\n",'  ','    ','     '), '', $buffer);
        /* remove other spaces before/after ) */
        $buffer = preg_replace(array('(( )+\))','(\)( )+)'), ')', $buffer);
        return $buffer;
  }
	
	
 public static function filePrune($filename,$maxfilesize = 4096, $pruneStart = true){
	 
	 if(filesize($filename) < $maxfilesize){
		return; 
	 }
	 
	 $maxfilesize = min($maxfilesize, filesize($filename));
     $maxfilesize = max($maxfilesize, 0);
	 
	 if(true!==$pruneStart){
		 $fp = fopen($filename, "r+");
         ftruncate($fp, $maxfilesize);
         fclose($fp);
		 return;
	 }
	 
        $size=filesize($filename);
        if ($size<$maxfilesize*1.0) return;
        $maxfilesize=$maxfilesize*0.5; //we don't want to do it too often...
        $fh=fopen($filename,"r+");
        $start=ftell($fh);
        fseek($fh,-$maxfilesize,SEEK_END);
        $drop=fgets($fh);
        $offset=ftell($fh);
        for ($x=0;$x<$maxfilesize;$x++){
            fseek($fh,$x+$offset);
            $c=fgetc($fh);
            fseek($fh,$x);
            fwrite($fh,$c);
        }
        ftruncate($fh,$maxfilesize-strlen($drop));
        fclose($fh);
 }
	
	
public static function getRootDir($path = null){
	if(null===$path){
		$path = $_SERVER['DOCUMENT_ROOT'];
	}

		
 if(''!==dirname($path) && '/'!==dirname($path) //&& @chmod(dirname($path), 0755) 
    &&  true===@is_writable(dirname($path))
    ){
 	return self::getRootDir(dirname($path));
 }else{
 	return $path;
 }

}
	
public static function getPathUrl($dir = null, $absolute = true){
	if(null===$dir){
	//	$dir = dirname($_SERVER['PHP_SELF']);
		$dir = getcwd();
	}elseif(is_file($dir)){
	  $dir = dirname($dir);	
	}

    $root = "";
    $dir = str_replace('\\', '/', realpath($dir));

    //HTTPS or HTTP
    $root .= ($absolute) ? (!empty($_SERVER['HTTPS']) ? 'https' : 'http') : '';

    //HOST
    $root .= ($absolute) ? '://' . $_SERVER['HTTP_HOST'] : '';

    //ALIAS
    if(!empty($_SERVER['CONTEXT_PREFIX'])) {
        $root .= $_SERVER['CONTEXT_PREFIX'];
        $root .= substr($dir, strlen($_SERVER[ 'CONTEXT_DOCUMENT_ROOT' ]));
    } else {
        $root .= substr($dir, strlen($_SERVER[ 'DOCUMENT_ROOT' ]));
    }

    $root .= '/';

    return $root;
}
	
	
public static function getRelativePath($from, $to){
    // some compatibility fixes for Windows paths
    $from = is_dir($from) ? rtrim($from, \DIRECTORY_SEPARATOR) .  \DIRECTORY_SEPARATOR : $from;
    $to   = is_dir($to)   ? rtrim($to,  \DIRECTORY_SEPARATOR) .  \DIRECTORY_SEPARATOR   : $to;
    $from = str_replace('\\',  \DIRECTORY_SEPARATOR, $from);
    $to   = str_replace('\\',  \DIRECTORY_SEPARATOR, $to);

    $from     = explode( \DIRECTORY_SEPARATOR, $from);
    $to       = explode( \DIRECTORY_SEPARATOR, $to);
    $relPath  = $to;

    foreach($from as $depth => $dir) {
        // find first non-matching dir
        if($dir === $to[$depth]) {
            // ignore this directory
            array_shift($relPath);
        } else {
            // get number of remaining dirs to $from
            $remaining = count($from) - $depth;
            if($remaining > 1) {
                // add traversals up to first matching dir
                $padLength = (count($relPath) + $remaining - 1) * -1;
                $relPath = array_pad($relPath, $padLength, '..');
                break;
            } else {
                $relPath[0] = '.'. \DIRECTORY_SEPARATOR . $relPath[0];
            }
        }
    }
    return implode( \DIRECTORY_SEPARATOR, $relPath);
}
	
	
public static function pruneDir($dir, $limit, $skipDotFiles = true, $remove = false){
 $iterator = new \DirectoryIterator($dir);
 $c = 0;
 $all = 0;	
 foreach ($iterator as $fileinfo) {
    if ($fileinfo->isFile()) {
		$c++;
		if(true===$skipDotFiles && '.'===substr($fileinfo->getFilename(),0,1))continue;
        if($fileinfo->getMTime() < time() - $limit){
			if(file_exists($fileinfo->getPathname()) && is_file($fileinfo->getPathname())
			    && strlen(realpath($fileinfo->getPathname())) > strlen(realpath($dir))
			  ){
				//  echo $fileinfo->getPathname();
			//  @chmod(dirname($fileinfo->getPathname()), 0775);	
			//  @chmod($fileinfo->getPathname(), 0775);
			    unlink($fileinfo->getPathname());
				$c=$c-1;
			}	
		}
    }elseif ($fileinfo->isDir()){
    	     $firstToken = substr(basename($fileinfo->getPathname()),0,1);
		 //    if('~'!==$firstToken)continue;
		       if('.'===$firstToken)continue;
         //    if('.'===substr($fileinfo->getFilename(),0,1))continue;
            $subdir = rtrim($fileinfo->getPathname(),'/ ') . DIRECTORY_SEPARATOR;
		 //   echo realpath($subdir);
		    $all += self::pruneDir($subdir, $limit, $skipDotFiles, true);
		 //  if(file_exists( $subdir . '.htaccess' ))continue;
	 //  	   pruneDir($subdir, $limit);
		 
	 //  	 if($fileinfo->getMTime() < time() - $limit){
	 //  	   register_shutdown_function(function($sd){
	 //  	   	  rmdir($sd);
	 //  	   }, $subdir);
	 //  	}   
		   
		
	}
 }//foreach ($iterator as $fileinfo) 
	
	if(true === $remove && 0 === max($c, $all)){
		 @rmdir($dir);
	}
	
	return $c;
}	
	
	
  public static function rglob($pattern, $flags = 0, $traversePostOrder = false) {
    // Keep away the hassles of the rest if we don't use the wildcard anyway
    if (strpos($pattern, '/**/') === false) {
        return glob($pattern, $flags);
    }

    $patternParts = explode('/**/', $pattern);

    // Get sub dirs
    $dirs = glob(array_shift($patternParts) . '/*', \GLOB_ONLYDIR | \GLOB_NOSORT);

    // Get files for current dir
    $files = glob($pattern, $flags);

    foreach ($dirs as $dir) {
        $subDirContent = self::rglob($dir . '/**/' . implode('/**/', $patternParts), $flags, $traversePostOrder);

        if (!$traversePostOrder) {
            $files = array_merge($files, $subDirContent);
        } else {
            $files = array_merge($subDirContent, $files);
        }
    }

    return $files;
 }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/webfan/hps/patch/ngScope.php" ; name="class webfan\hps\patch\ngScope"
Content-Type: application/x-httpd-php

<?php 



namespace webfan\hps\patch;




class ngScope extends \ArrayObject
{
	 static $debugLevel = 1;
	
	 protected $___class = null;
	
	
    function __construct($input=[]){
        parent::__construct($input,\ArrayObject::STD_PROP_LIST|\ArrayObject::ARRAY_AS_PROPS);
    }
	

    public function importObj($class,  $array = []){
        $this->___class = $class;
        if(count($array) > 0){
            $this->import($array);
        }
        return $this;
    }

    public function import($input)
    {
        $this->exchangeArray($input);
        return $this;
    }

    public function export()
    {
        return $this->objectToArray($this->getArrayCopy());
    }

    public function objectToArray ($object) {
        $o = [];
        foreach ($object as $key => $value) {
           $o[$key] = is_object($value) ? (array) $value: $value;
        }
        return $o;
    }

	
	
	
    public function __call($func, $argv)
    {
        if(is_callable($func) && substr($func, 0, 6) === 'array_'){ 
			return call_user_func_array($func, array_merge(array($this->getArrayCopy()), $argv));
        }
      
        if(is_object($this->___class) && is_callable([$this->___class, $key])){
            return call_user_func_array([$this->___class, $key],$args);
        }
        $result = is_callable($c = $this->__get($key)) ? call_user_func_array($c, $args) : new \BadMethodCallException(__CLASS__.'->'.$func);
		
		if($result instanceof \Exception){
			throw $result;
		}
		
	  return $result;
    }	
	
	
  public function &__get($key)
    {
        return $this[$key];
    }

    public function __set($key, $value)
    {
        $this[$key] =  $value;
    }

    public function __isset($name)
    {
        return isset($this[$name]);
    }
	
	
  



        public function offsetGet($name){
			 return parent::offsetGet($name);
        }
        public function offsetSet($name, $value){
			return parent::offsetSet($name, $value);
        }
        public function offsetExists($name){
			return parent::offsetExists($name);
        }
        public function offsetUnset($name){
			 return parent::offsetUnset($name);
        } 	
	
	
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Finite/StatefulInterface.php" ; name="class Finite\StatefulInterface"
Content-Type: application/x-httpd-php

<?php 

namespace Finite;

/**
 * Implementing this interface make an object Stateful and
 * able to be handled by the state machine.
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
interface StatefulInterface
{
    /**
     * Gets the object state.
     *
     * @return string
     */
    public function getFiniteState();

    /**
     * Sets the object state.
     *
     * @param string $state
     */
    public function setFiniteState($state);
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Finite/Event/TransitionEvent.php" ; name="class Finite\Event\TransitionEvent"
Content-Type: application/x-httpd-php

<?php 

namespace Finite\Event;

use Finite\State\StateInterface;
use Finite\StateMachine\StateMachine;
use Finite\Transition\PropertiesAwareTransitionInterface;
use Finite\Transition\TransitionInterface;

/**
 * The event object which is thrown on transitions actions.
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class TransitionEvent extends StateMachineEvent
{
    /**
     * @var TransitionInterface
     */
    protected $transition;

    /**
     * @var bool
     */
    protected $transitionRejected = false;

    /**
     * @var StateInterface
     */
    protected $initialState;

    /**
     * @var array
     */
    protected $properties;

    /**
     * @param StateInterface      $initialState
     * @param TransitionInterface $transition
     * @param StateMachine        $stateMachine
     * @param array               $properties
     */
    public function __construct(
        StateInterface $initialState,
        TransitionInterface $transition,
        StateMachine $stateMachine,
        array $properties = array()
    ) {
        $this->transition = $transition;
        $this->initialState = $initialState;
        $this->properties = $properties;

        if ($transition instanceof PropertiesAwareTransitionInterface) {
            $this->properties = $transition->resolveProperties($properties);
        }

        parent::__construct($stateMachine);
    }

    /**
     * @return TransitionInterface
     */
    public function getTransition()
    {
        return $this->transition;
    }

    /**
     * @return bool
     */
    public function isRejected()
    {
        return $this->transitionRejected;
    }

    public function reject()
    {
        $this->transitionRejected = true;
    }

    /**
     * @return StateInterface
     */
    public function getInitialState()
    {
        return $this->initialState;
    }

    /**
     * @param string $property
     *
     * @return bool
     */
    public function has($property)
    {
        return array_key_exists($property, $this->properties);
    }

    /**
     * @param string $property
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($property, $default = null)
    {
        return $this->has($property) ? $this->properties[$property] : $default;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Finite/State/StateInterface.php" ; name="class Finite\State\StateInterface"
Content-Type: application/x-httpd-php

<?php 

namespace Finite\State;

use Finite\PropertiesAwareInterface;

/**
 * The base State Interface.
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
interface StateInterface extends PropertiesAwareInterface
{
    const
        TYPE_INITIAL = 'initial',
        TYPE_NORMAL = 'normal',
        TYPE_FINAL = 'final'
    ;

    /**
     * Returns the state name.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns if this state is the initial state.
     *
     * @return bool
     */
    public function isInitial();

    /**
     * Returns if this state is the final state.
     *
     * @return mixed
     */
    public function isFinal();

    /**
     * Returns if this state is a normal state (!($this->isInitial() || $this->isFinal()).
     *
     * @return mixed
     */
    public function isNormal();

    /**
     * Returns the state type.
     *
     * @return string
     */
    public function getType();

    /**
     * Returns the available transitions.
     *
     * @return array
     */
    public function getTransitions();

    /**
     * Returns if this state can run $transition.
     *
     * @param string|\Finite\Transition\TransitionInterface $transition
     *
     * @return bool
     *
     * @deprecated Deprecated since version 1.0.0-BETA2. Use {@link StateMachine::can($transition)} instead.
     */
    public function can($transition);
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Finite/Loader/ArrayLoader.php" ; name="class Finite\Loader\ArrayLoader"
Content-Type: application/x-httpd-php

<?php 

namespace Finite\Loader;

use Finite\Event\Callback\CallbackBuilderFactory;
use Finite\Event\Callback\CallbackBuilderFactoryInterface;
use Finite\Event\CallbackHandler;
use Finite\State\Accessor\PropertyPathStateAccessor;
use Finite\StateMachine\StateMachineInterface;
use Finite\State\State;
use Finite\State\StateInterface;
use Finite\Transition\Transition;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Loads a StateMachine from an array.
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class ArrayLoader implements LoaderInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var CallbackHandler
     */
    private $callbackHandler;

    /**
     * @var CallbackBuilderFactoryInterface
     */
    private $callbackBuilderFactory;

    /**
     * @param array                           $config
     * @param CallbackHandler                 $handler
     * @param CallbackBuilderFactoryInterface $callbackBuilderFactory
     */
    public function __construct(array $config, CallbackHandler $handler = null, CallbackBuilderFactoryInterface $callbackBuilderFactory = null)
    {
        $this->callbackHandler = $handler;
        $this->callbackBuilderFactory = $callbackBuilderFactory;
        $this->config = array_merge(
            array(
                'class' => '',
                'graph' => 'default',
                'property_path' => 'finiteState',
                'states' => array(),
                'transitions' => array(),
            ),
            $config
        );
    }

    /**
     * {@inheritdoc}
     */
    public function load(StateMachineInterface $stateMachine)
    {
        if (null === $this->callbackHandler) {
            $this->callbackHandler = new CallbackHandler($stateMachine->getDispatcher());
        }

        if (null === $this->callbackBuilderFactory) {
            $this->callbackBuilderFactory = new CallbackBuilderFactory();
        }

        if (!$stateMachine->hasStateAccessor()) {
            $stateMachine->setStateAccessor(new PropertyPathStateAccessor($this->config['property_path']));
        }

        $stateMachine->setGraph($this->config['graph']);

        $this->loadStates($stateMachine);
        $this->loadTransitions($stateMachine);
        $this->loadCallbacks($stateMachine);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($object, $graph = 'default')
    {
        $reflection = new \ReflectionClass($this->config['class']);

        return $reflection->isInstance($object) && $graph === $this->config['graph'];
    }

    /**
     * @param StateMachineInterface $stateMachine
     */
    private function loadStates(StateMachineInterface $stateMachine)
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults(array('type' => StateInterface::TYPE_NORMAL, 'properties' => array()));
        $resolver->setAllowedValues('type', array(
            StateInterface::TYPE_INITIAL,
            StateInterface::TYPE_NORMAL,
            StateInterface::TYPE_FINAL,
        ));

        foreach ($this->config['states'] as $state => $config) {
            $config = $resolver->resolve($config);
            $stateMachine->addState(new State($state, $config['type'], array(), $config['properties']));
        }
    }

    /**
     * @param StateMachineInterface $stateMachine
     */
    private function loadTransitions(StateMachineInterface $stateMachine)
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired(array('from', 'to'));
        $resolver->setDefaults(array('guard' => null, 'configure_properties' => null, 'properties' => array()));

        $resolver->setAllowedTypes('configure_properties', array('null', 'callable'));

        $resolver->setNormalizer('from', function (Options $options, $v) { return (array) $v; });
        $resolver->setNormalizer('guard', function (Options $options, $v) { return !isset($v) ? null : $v; });
        $resolver->setNormalizer('configure_properties', function (Options $options, $v) {
            $resolver = new OptionsResolver();

            $resolver->setDefaults($options['properties']);

            if (is_callable($v)) {
                $v($resolver);
            }

            return $resolver;
        });

        foreach ($this->config['transitions'] as $transition => $config) {
            $config = $resolver->resolve($config);
            $stateMachine->addTransition(
                new Transition(
                    $transition,
                    $config['from'],
                    $config['to'],
                    $config['guard'],
                    $config['configure_properties']
                )
            );
        }
    }

    /**
     * @param StateMachineInterface $stateMachine
     */
    private function loadCallbacks(StateMachineInterface $stateMachine)
    {
        if (!isset($this->config['callbacks'])) {
            return;
        }

        foreach (array('before', 'after') as $position) {
            $this->loadCallbacksFor($position, $stateMachine);
        }
    }

    private function loadCallbacksFor($position, $stateMachine)
    {
        if (!isset($this->config['callbacks'][$position])) {
            return;
        }

        $method = 'add'.ucfirst($position);
        $resolver = $this->getCallbacksResolver();
        foreach ($this->config['callbacks'][$position] as $specs) {
            $specs = $resolver->resolve($specs);

            $callback = $this->callbackBuilderFactory->createBuilder($stateMachine)
                ->setFrom($specs['from'])
                ->setTo($specs['to'])
                ->setOn($specs['on'])
                ->setCallable($specs['do'])
                ->getCallback();

            $this->callbackHandler->$method($callback);
        }
    }

    private function getCallbacksResolver()
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults(
            array(
                'on' => array(),
                'from' => array(),
                'to' => array(),
            )
        );

        $resolver->setRequired(array('do'));

        $resolver->setAllowedTypes('on',   array('string', 'array'));
        $resolver->setAllowedTypes('from', array('string', 'array'));
        $resolver->setAllowedTypes('to',   array('string', 'array'));

        $toArrayNormalizer = function (Options $options, $value) {
            return (array) $value;
        };
        $resolver->setNormalizer('on',  $toArrayNormalizer);
        $resolver->setNormalizer('from', $toArrayNormalizer);
        $resolver->setNormalizer('to',   $toArrayNormalizer);

        return $resolver;
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/Symfony/Component/OptionsResolver/OptionsResolver.php" ; name="class Symfony\Component\OptionsResolver\OptionsResolver"
Content-Type: application/x-httpd-php

<?php 

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\OptionsResolver;

use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\OptionsResolver\Exception\NoSuchOptionException;
use Symfony\Component\OptionsResolver\Exception\OptionDefinitionException;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;

/**
 * Validates options and merges them with default values.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 * @author Tobias Schultze <http://tobion.de>
 */
class OptionsResolver implements Options
{
    /**
     * The names of all defined options.
     */
    private $defined = array();

    /**
     * The default option values.
     */
    private $defaults = array();

    /**
     * The names of required options.
     */
    private $required = array();

    /**
     * The resolved option values.
     */
    private $resolved = array();

    /**
     * A list of normalizer closures.
     *
     * @var \Closure[]
     */
    private $normalizers = array();

    /**
     * A list of accepted values for each option.
     */
    private $allowedValues = array();

    /**
     * A list of accepted types for each option.
     */
    private $allowedTypes = array();

    /**
     * A list of closures for evaluating lazy options.
     */
    private $lazy = array();

    /**
     * A list of lazy options whose closure is currently being called.
     *
     * This list helps detecting circular dependencies between lazy options.
     */
    private $calling = array();

    /**
     * Whether the instance is locked for reading.
     *
     * Once locked, the options cannot be changed anymore. This is
     * necessary in order to avoid inconsistencies during the resolving
     * process. If any option is changed after being read, all evaluated
     * lazy options that depend on this option would become invalid.
     */
    private $locked = false;

    private static $typeAliases = array(
        'boolean' => 'bool',
        'integer' => 'int',
        'double' => 'float',
    );

    /**
     * Sets the default value of a given option.
     *
     * If the default value should be set based on other options, you can pass
     * a closure with the following signature:
     *
     *     function (Options $options) {
     *         // ...
     *     }
     *
     * The closure will be evaluated when {@link resolve()} is called. The
     * closure has access to the resolved values of other options through the
     * passed {@link Options} instance:
     *
     *     function (Options $options) {
     *         if (isset($options['port'])) {
     *             // ...
     *         }
     *     }
     *
     * If you want to access the previously set default value, add a second
     * argument to the closure's signature:
     *
     *     $options->setDefault('name', 'Default Name');
     *
     *     $options->setDefault('name', function (Options $options, $previousValue) {
     *         // 'Default Name' === $previousValue
     *     });
     *
     * This is mostly useful if the configuration of the {@link Options} object
     * is spread across different locations of your code, such as base and
     * sub-classes.
     *
     * @param string $option The name of the option
     * @param mixed  $value  The default value of the option
     *
     * @return $this
     *
     * @throws AccessException If called from a lazy option or normalizer
     */
    public function setDefault($option, $value)
    {
        // Setting is not possible once resolving starts, because then lazy
        // options could manipulate the state of the object, leading to
        // inconsistent results.
        if ($this->locked) {
            throw new AccessException('Default values cannot be set from a lazy option or normalizer.');
        }

        // If an option is a closure that should be evaluated lazily, store it
        // in the "lazy" property.
        if ($value instanceof \Closure) {
            $reflClosure = new \ReflectionFunction($value);
            $params = $reflClosure->getParameters();

            if (isset($params[0]) && null !== ($class = $params[0]->getClass()) && Options::class === $class->name) {
                // Initialize the option if no previous value exists
                if (!isset($this->defaults[$option])) {
                    $this->defaults[$option] = null;
                }

                // Ignore previous lazy options if the closure has no second parameter
                if (!isset($this->lazy[$option]) || !isset($params[1])) {
                    $this->lazy[$option] = array();
                }

                // Store closure for later evaluation
                $this->lazy[$option][] = $value;
                $this->defined[$option] = true;

                // Make sure the option is processed
                unset($this->resolved[$option]);

                return $this;
            }
        }

        // This option is not lazy anymore
        unset($this->lazy[$option]);

        // Yet undefined options can be marked as resolved, because we only need
        // to resolve options with lazy closures, normalizers or validation
        // rules, none of which can exist for undefined options
        // If the option was resolved before, update the resolved value
        if (!isset($this->defined[$option]) || array_key_exists($option, $this->resolved)) {
            $this->resolved[$option] = $value;
        }

        $this->defaults[$option] = $value;
        $this->defined[$option] = true;

        return $this;
    }

    /**
     * Sets a list of default values.
     *
     * @param array $defaults The default values to set
     *
     * @return $this
     *
     * @throws AccessException If called from a lazy option or normalizer
     */
    public function setDefaults(array $defaults)
    {
        foreach ($defaults as $option => $value) {
            $this->setDefault($option, $value);
        }

        return $this;
    }

    /**
     * Returns whether a default value is set for an option.
     *
     * Returns true if {@link setDefault()} was called for this option.
     * An option is also considered set if it was set to null.
     *
     * @param string $option The option name
     *
     * @return bool Whether a default value is set
     */
    public function hasDefault($option)
    {
        return array_key_exists($option, $this->defaults);
    }

    /**
     * Marks one or more options as required.
     *
     * @param string|string[] $optionNames One or more option names
     *
     * @return $this
     *
     * @throws AccessException If called from a lazy option or normalizer
     */
    public function setRequired($optionNames)
    {
        if ($this->locked) {
            throw new AccessException('Options cannot be made required from a lazy option or normalizer.');
        }

        foreach ((array) $optionNames as $option) {
            $this->defined[$option] = true;
            $this->required[$option] = true;
        }

        return $this;
    }

    /**
     * Returns whether an option is required.
     *
     * An option is required if it was passed to {@link setRequired()}.
     *
     * @param string $option The name of the option
     *
     * @return bool Whether the option is required
     */
    public function isRequired($option)
    {
        return isset($this->required[$option]);
    }

    /**
     * Returns the names of all required options.
     *
     * @return string[] The names of the required options
     *
     * @see isRequired()
     */
    public function getRequiredOptions()
    {
        return array_keys($this->required);
    }

    /**
     * Returns whether an option is missing a default value.
     *
     * An option is missing if it was passed to {@link setRequired()}, but not
     * to {@link setDefault()}. This option must be passed explicitly to
     * {@link resolve()}, otherwise an exception will be thrown.
     *
     * @param string $option The name of the option
     *
     * @return bool Whether the option is missing
     */
    public function isMissing($option)
    {
        return isset($this->required[$option]) && !array_key_exists($option, $this->defaults);
    }

    /**
     * Returns the names of all options missing a default value.
     *
     * @return string[] The names of the missing options
     *
     * @see isMissing()
     */
    public function getMissingOptions()
    {
        return array_keys(array_diff_key($this->required, $this->defaults));
    }

    /**
     * Defines a valid option name.
     *
     * Defines an option name without setting a default value. The option will
     * be accepted when passed to {@link resolve()}. When not passed, the
     * option will not be included in the resolved options.
     *
     * @param string|string[] $optionNames One or more option names
     *
     * @return $this
     *
     * @throws AccessException If called from a lazy option or normalizer
     */
    public function setDefined($optionNames)
    {
        if ($this->locked) {
            throw new AccessException('Options cannot be defined from a lazy option or normalizer.');
        }

        foreach ((array) $optionNames as $option) {
            $this->defined[$option] = true;
        }

        return $this;
    }

    /**
     * Returns whether an option is defined.
     *
     * Returns true for any option passed to {@link setDefault()},
     * {@link setRequired()} or {@link setDefined()}.
     *
     * @param string $option The option name
     *
     * @return bool Whether the option is defined
     */
    public function isDefined($option)
    {
        return isset($this->defined[$option]);
    }

    /**
     * Returns the names of all defined options.
     *
     * @return string[] The names of the defined options
     *
     * @see isDefined()
     */
    public function getDefinedOptions()
    {
        return array_keys($this->defined);
    }

    /**
     * Sets the normalizer for an option.
     *
     * The normalizer should be a closure with the following signature:
     *
     * ```php
     * function (Options $options, $value) {
     *     // ...
     * }
     * ```
     *
     * The closure is invoked when {@link resolve()} is called. The closure
     * has access to the resolved values of other options through the passed
     * {@link Options} instance.
     *
     * The second parameter passed to the closure is the value of
     * the option.
     *
     * The resolved option value is set to the return value of the closure.
     *
     * @param string   $option     The option name
     * @param \Closure $normalizer The normalizer
     *
     * @return $this
     *
     * @throws UndefinedOptionsException If the option is undefined
     * @throws AccessException           If called from a lazy option or normalizer
     */
    public function setNormalizer($option, \Closure $normalizer)
    {
        if ($this->locked) {
            throw new AccessException('Normalizers cannot be set from a lazy option or normalizer.');
        }

        if (!isset($this->defined[$option])) {
            throw new UndefinedOptionsException(sprintf(
                'The option "%s" does not exist. Defined options are: "%s".',
                $option,
                implode('", "', array_keys($this->defined))
            ));
        }

        $this->normalizers[$option] = $normalizer;

        // Make sure the option is processed
        unset($this->resolved[$option]);

        return $this;
    }

    /**
     * Sets allowed values for an option.
     *
     * Instead of passing values, you may also pass a closures with the
     * following signature:
     *
     *     function ($value) {
     *         // return true or false
     *     }
     *
     * The closure receives the value as argument and should return true to
     * accept the value and false to reject the value.
     *
     * @param string $option        The option name
     * @param mixed  $allowedValues One or more acceptable values/closures
     *
     * @return $this
     *
     * @throws UndefinedOptionsException If the option is undefined
     * @throws AccessException           If called from a lazy option or normalizer
     */
    public function setAllowedValues($option, $allowedValues)
    {
        if ($this->locked) {
            throw new AccessException('Allowed values cannot be set from a lazy option or normalizer.');
        }

        if (!isset($this->defined[$option])) {
            throw new UndefinedOptionsException(sprintf(
                'The option "%s" does not exist. Defined options are: "%s".',
                $option,
                implode('", "', array_keys($this->defined))
            ));
        }

        $this->allowedValues[$option] = is_array($allowedValues) ? $allowedValues : array($allowedValues);

        // Make sure the option is processed
        unset($this->resolved[$option]);

        return $this;
    }

    /**
     * Adds allowed values for an option.
     *
     * The values are merged with the allowed values defined previously.
     *
     * Instead of passing values, you may also pass a closures with the
     * following signature:
     *
     *     function ($value) {
     *         // return true or false
     *     }
     *
     * The closure receives the value as argument and should return true to
     * accept the value and false to reject the value.
     *
     * @param string $option        The option name
     * @param mixed  $allowedValues One or more acceptable values/closures
     *
     * @return $this
     *
     * @throws UndefinedOptionsException If the option is undefined
     * @throws AccessException           If called from a lazy option or normalizer
     */
    public function addAllowedValues($option, $allowedValues)
    {
        if ($this->locked) {
            throw new AccessException('Allowed values cannot be added from a lazy option or normalizer.');
        }

        if (!isset($this->defined[$option])) {
            throw new UndefinedOptionsException(sprintf(
                'The option "%s" does not exist. Defined options are: "%s".',
                $option,
                implode('", "', array_keys($this->defined))
            ));
        }

        if (!is_array($allowedValues)) {
            $allowedValues = array($allowedValues);
        }

        if (!isset($this->allowedValues[$option])) {
            $this->allowedValues[$option] = $allowedValues;
        } else {
            $this->allowedValues[$option] = array_merge($this->allowedValues[$option], $allowedValues);
        }

        // Make sure the option is processed
        unset($this->resolved[$option]);

        return $this;
    }

    /**
     * Sets allowed types for an option.
     *
     * Any type for which a corresponding is_<type>() function exists is
     * acceptable. Additionally, fully-qualified class or interface names may
     * be passed.
     *
     * @param string          $option       The option name
     * @param string|string[] $allowedTypes One or more accepted types
     *
     * @return $this
     *
     * @throws UndefinedOptionsException If the option is undefined
     * @throws AccessException           If called from a lazy option or normalizer
     */
    public function setAllowedTypes($option, $allowedTypes)
    {
        if ($this->locked) {
            throw new AccessException('Allowed types cannot be set from a lazy option or normalizer.');
        }

        if (!isset($this->defined[$option])) {
            throw new UndefinedOptionsException(sprintf(
                'The option "%s" does not exist. Defined options are: "%s".',
                $option,
                implode('", "', array_keys($this->defined))
            ));
        }

        $this->allowedTypes[$option] = (array) $allowedTypes;

        // Make sure the option is processed
        unset($this->resolved[$option]);

        return $this;
    }

    /**
     * Adds allowed types for an option.
     *
     * The types are merged with the allowed types defined previously.
     *
     * Any type for which a corresponding is_<type>() function exists is
     * acceptable. Additionally, fully-qualified class or interface names may
     * be passed.
     *
     * @param string          $option       The option name
     * @param string|string[] $allowedTypes One or more accepted types
     *
     * @return $this
     *
     * @throws UndefinedOptionsException If the option is undefined
     * @throws AccessException           If called from a lazy option or normalizer
     */
    public function addAllowedTypes($option, $allowedTypes)
    {
        if ($this->locked) {
            throw new AccessException('Allowed types cannot be added from a lazy option or normalizer.');
        }

        if (!isset($this->defined[$option])) {
            throw new UndefinedOptionsException(sprintf(
                'The option "%s" does not exist. Defined options are: "%s".',
                $option,
                implode('", "', array_keys($this->defined))
            ));
        }

        if (!isset($this->allowedTypes[$option])) {
            $this->allowedTypes[$option] = (array) $allowedTypes;
        } else {
            $this->allowedTypes[$option] = array_merge($this->allowedTypes[$option], (array) $allowedTypes);
        }

        // Make sure the option is processed
        unset($this->resolved[$option]);

        return $this;
    }

    /**
     * Removes the option with the given name.
     *
     * Undefined options are ignored.
     *
     * @param string|string[] $optionNames One or more option names
     *
     * @return $this
     *
     * @throws AccessException If called from a lazy option or normalizer
     */
    public function remove($optionNames)
    {
        if ($this->locked) {
            throw new AccessException('Options cannot be removed from a lazy option or normalizer.');
        }

        foreach ((array) $optionNames as $option) {
            unset($this->defined[$option], $this->defaults[$option], $this->required[$option], $this->resolved[$option]);
            unset($this->lazy[$option], $this->normalizers[$option], $this->allowedTypes[$option], $this->allowedValues[$option]);
        }

        return $this;
    }

    /**
     * Removes all options.
     *
     * @return $this
     *
     * @throws AccessException If called from a lazy option or normalizer
     */
    public function clear()
    {
        if ($this->locked) {
            throw new AccessException('Options cannot be cleared from a lazy option or normalizer.');
        }

        $this->defined = array();
        $this->defaults = array();
        $this->required = array();
        $this->resolved = array();
        $this->lazy = array();
        $this->normalizers = array();
        $this->allowedTypes = array();
        $this->allowedValues = array();

        return $this;
    }

    /**
     * Merges options with the default values stored in the container and
     * validates them.
     *
     * Exceptions are thrown if:
     *
     *  - Undefined options are passed;
     *  - Required options are missing;
     *  - Options have invalid types;
     *  - Options have invalid values.
     *
     * @param array $options A map of option names to values
     *
     * @return array The merged and validated options
     *
     * @throws UndefinedOptionsException If an option name is undefined
     * @throws InvalidOptionsException   If an option doesn't fulfill the
     *                                   specified validation rules
     * @throws MissingOptionsException   If a required option is missing
     * @throws OptionDefinitionException If there is a cyclic dependency between
     *                                   lazy options and/or normalizers
     * @throws NoSuchOptionException     If a lazy option reads an unavailable option
     * @throws AccessException           If called from a lazy option or normalizer
     */
    public function resolve(array $options = array())
    {
        if ($this->locked) {
            throw new AccessException('Options cannot be resolved from a lazy option or normalizer.');
        }

        // Allow this method to be called multiple times
        $clone = clone $this;

        // Make sure that no unknown options are passed
        $diff = array_diff_key($options, $clone->defined);

        if (count($diff) > 0) {
            ksort($clone->defined);
            ksort($diff);

            throw new UndefinedOptionsException(sprintf(
                (count($diff) > 1 ? 'The options "%s" do not exist.' : 'The option "%s" does not exist.').' Defined options are: "%s".',
                implode('", "', array_keys($diff)),
                implode('", "', array_keys($clone->defined))
            ));
        }

        // Override options set by the user
        foreach ($options as $option => $value) {
            $clone->defaults[$option] = $value;
            unset($clone->resolved[$option], $clone->lazy[$option]);
        }

        // Check whether any required option is missing
        $diff = array_diff_key($clone->required, $clone->defaults);

        if (count($diff) > 0) {
            ksort($diff);

            throw new MissingOptionsException(sprintf(
                count($diff) > 1 ? 'The required options "%s" are missing.' : 'The required option "%s" is missing.',
                implode('", "', array_keys($diff))
            ));
        }

        // Lock the container
        $clone->locked = true;

        // Now process the individual options. Use offsetGet(), which resolves
        // the option itself and any options that the option depends on
        foreach ($clone->defaults as $option => $_) {
            $clone->offsetGet($option);
        }

        return $clone->resolved;
    }

    /**
     * Returns the resolved value of an option.
     *
     * @param string $option The option name
     *
     * @return mixed The option value
     *
     * @throws AccessException           If accessing this method outside of
     *                                   {@link resolve()}
     * @throws NoSuchOptionException     If the option is not set
     * @throws InvalidOptionsException   If the option doesn't fulfill the
     *                                   specified validation rules
     * @throws OptionDefinitionException If there is a cyclic dependency between
     *                                   lazy options and/or normalizers
     */
    public function offsetGet($option)
    {
        if (!$this->locked) {
            throw new AccessException('Array access is only supported within closures of lazy options and normalizers.');
        }

        // Shortcut for resolved options
        if (array_key_exists($option, $this->resolved)) {
            return $this->resolved[$option];
        }

        // Check whether the option is set at all
        if (!array_key_exists($option, $this->defaults)) {
            if (!isset($this->defined[$option])) {
                throw new NoSuchOptionException(sprintf(
                    'The option "%s" does not exist. Defined options are: "%s".',
                    $option,
                    implode('", "', array_keys($this->defined))
                ));
            }

            throw new NoSuchOptionException(sprintf(
                'The optional option "%s" has no value set. You should make sure it is set with "isset" before reading it.',
                $option
            ));
        }

        $value = $this->defaults[$option];

        // Resolve the option if the default value is lazily evaluated
        if (isset($this->lazy[$option])) {
            // If the closure is already being called, we have a cyclic
            // dependency
            if (isset($this->calling[$option])) {
                throw new OptionDefinitionException(sprintf(
                    'The options "%s" have a cyclic dependency.',
                    implode('", "', array_keys($this->calling))
                ));
            }

            // The following section must be protected from cyclic
            // calls. Set $calling for the current $option to detect a cyclic
            // dependency
            // BEGIN
            $this->calling[$option] = true;
            try {
                foreach ($this->lazy[$option] as $closure) {
                    $value = $closure($this, $value);
                }
            } finally {
                unset($this->calling[$option]);
            }
            // END
        }

        // Validate the type of the resolved option
        if (isset($this->allowedTypes[$option])) {
            $valid = false;
            $invalidTypes = array();

            foreach ($this->allowedTypes[$option] as $type) {
                $type = isset(self::$typeAliases[$type]) ? self::$typeAliases[$type] : $type;

                if ($valid = $this->verifyTypes($type, $value, $invalidTypes)) {
                    break;
                }
            }

            if (!$valid) {
                throw new InvalidOptionsException(sprintf(
                    'The option "%s" with value %s is expected to be of type '.
                    '"%s", but is of type "%s".',
                    $option,
                    $this->formatValue($value),
                    implode('" or "', $this->allowedTypes[$option]),
                    implode('|', array_keys($invalidTypes))
                ));
            }
        }

        // Validate the value of the resolved option
        if (isset($this->allowedValues[$option])) {
            $success = false;
            $printableAllowedValues = array();

            foreach ($this->allowedValues[$option] as $allowedValue) {
                if ($allowedValue instanceof \Closure) {
                    if ($allowedValue($value)) {
                        $success = true;
                        break;
                    }

                    // Don't include closures in the exception message
                    continue;
                } elseif ($value === $allowedValue) {
                    $success = true;
                    break;
                }

                $printableAllowedValues[] = $allowedValue;
            }

            if (!$success) {
                $message = sprintf(
                    'The option "%s" with value %s is invalid.',
                    $option,
                    $this->formatValue($value)
                );

                if (count($printableAllowedValues) > 0) {
                    $message .= sprintf(
                        ' Accepted values are: %s.',
                        $this->formatValues($printableAllowedValues)
                    );
                }

                throw new InvalidOptionsException($message);
            }
        }

        // Normalize the validated option
        if (isset($this->normalizers[$option])) {
            // If the closure is already being called, we have a cyclic
            // dependency
            if (isset($this->calling[$option])) {
                throw new OptionDefinitionException(sprintf(
                    'The options "%s" have a cyclic dependency.',
                    implode('", "', array_keys($this->calling))
                ));
            }

            $normalizer = $this->normalizers[$option];

            // The following section must be protected from cyclic
            // calls. Set $calling for the current $option to detect a cyclic
            // dependency
            // BEGIN
            $this->calling[$option] = true;
            try {
                $value = $normalizer($this, $value);
            } finally {
                unset($this->calling[$option]);
            }
            // END
        }

        // Mark as resolved
        $this->resolved[$option] = $value;

        return $value;
    }

    /**
     * @param string $type
     * @param mixed  $value
     * @param array  &$invalidTypes
     *
     * @return bool
     */
    private function verifyTypes($type, $value, array &$invalidTypes)
    {
        if ('[]' === substr($type, -2) && is_array($value)) {
            $originalType = $type;
            $type = substr($type, 0, -2);
            $invalidValues = array_filter( // Filter out valid values, keeping invalid values in the resulting array
                $value,
                function ($value) use ($type) {
                    return !self::isValueValidType($type, $value);
                }
            );

            if (!$invalidValues) {
                return true;
            }

            $invalidTypes[$this->formatTypeOf($value, $originalType)] = true;

            return false;
        }

        if (self::isValueValidType($type, $value)) {
            return true;
        }

        if (!$invalidTypes) {
            $invalidTypes[$this->formatTypeOf($value, null)] = true;
        }

        return false;
    }

    /**
     * Returns whether a resolved option with the given name exists.
     *
     * @param string $option The option name
     *
     * @return bool Whether the option is set
     *
     * @throws AccessException If accessing this method outside of {@link resolve()}
     *
     * @see \ArrayAccess::offsetExists()
     */
    public function offsetExists($option)
    {
        if (!$this->locked) {
            throw new AccessException('Array access is only supported within closures of lazy options and normalizers.');
        }

        return array_key_exists($option, $this->defaults);
    }

    /**
     * Not supported.
     *
     * @throws AccessException
     */
    public function offsetSet($option, $value)
    {
        throw new AccessException('Setting options via array access is not supported. Use setDefault() instead.');
    }

    /**
     * Not supported.
     *
     * @throws AccessException
     */
    public function offsetUnset($option)
    {
        throw new AccessException('Removing options via array access is not supported. Use remove() instead.');
    }

    /**
     * Returns the number of set options.
     *
     * This may be only a subset of the defined options.
     *
     * @return int Number of options
     *
     * @throws AccessException If accessing this method outside of {@link resolve()}
     *
     * @see \Countable::count()
     */
    public function count()
    {
        if (!$this->locked) {
            throw new AccessException('Counting is only supported within closures of lazy options and normalizers.');
        }

        return count($this->defaults);
    }

    /**
     * Returns a string representation of the type of the value.
     *
     * This method should be used if you pass the type of a value as
     * message parameter to a constraint violation. Note that such
     * parameters should usually not be included in messages aimed at
     * non-technical people.
     *
     * @param mixed  $value The value to return the type of
     * @param string $type
     *
     * @return string The type of the value
     */
    private function formatTypeOf($value, $type)
    {
        $suffix = '';

        if ('[]' === substr($type, -2)) {
            $suffix = '[]';
            $type = substr($type, 0, -2);
            while ('[]' === substr($type, -2)) {
                $type = substr($type, 0, -2);
                $value = array_shift($value);
                if (!is_array($value)) {
                    break;
                }
                $suffix .= '[]';
            }

            if (is_array($value)) {
                $subTypes = array();
                foreach ($value as $val) {
                    $subTypes[$this->formatTypeOf($val, null)] = true;
                }

                return implode('|', array_keys($subTypes)).$suffix;
            }
        }

        return (is_object($value) ? get_class($value) : gettype($value)).$suffix;
    }

    /**
     * Returns a string representation of the value.
     *
     * This method returns the equivalent PHP tokens for most scalar types
     * (i.e. "false" for false, "1" for 1 etc.). Strings are always wrapped
     * in double quotes (").
     *
     * @param mixed $value The value to format as string
     *
     * @return string The string representation of the passed value
     */
    private function formatValue($value)
    {
        if (is_object($value)) {
            return get_class($value);
        }

        if (is_array($value)) {
            return 'array';
        }

        if (is_string($value)) {
            return '"'.$value.'"';
        }

        if (is_resource($value)) {
            return 'resource';
        }

        if (null === $value) {
            return 'null';
        }

        if (false === $value) {
            return 'false';
        }

        if (true === $value) {
            return 'true';
        }

        return (string) $value;
    }

    /**
     * Returns a string representation of a list of values.
     *
     * Each of the values is converted to a string using
     * {@link formatValue()}. The values are then concatenated with commas.
     *
     * @param array $values A list of values
     *
     * @return string The string representation of the value list
     *
     * @see formatValue()
     */
    private function formatValues(array $values)
    {
        foreach ($values as $key => $value) {
            $values[$key] = $this->formatValue($value);
        }

        return implode(', ', $values);
    }

    private static function isValueValidType($type, $value)
    {
        return (function_exists($isFunction = 'is_'.$type) && $isFunction($value)) || $value instanceof $type;
    }
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$DIR_PSR4/frdl_polyfill.php" ; name="class frdl_polyfill"
Content-Type: application/x-httpd-php

<?php 

if (PHP_VERSION_ID < 70200) {
    if ('\\' === DIRECTORY_SEPARATOR && !function_exists('sapi_windows_vt100_support')) {
        function sapi_windows_vt100_support($stream, $enable = null) { return \myFork\Symfony\Polyfill\Php_72\Php72::sapi_windows_vt100_support($stream, $enable); }
    }
    if (!function_exists('stream_isatty')) {
        function stream_isatty($stream) { return \myFork\Symfony\Polyfill\Php_72\Php72::stream_isatty($stream); }
    }
    if (!function_exists('utf8_encode')) {
        function utf8_encode($s) { return \myFork\Symfony\Polyfill\Php_72\Php72::utf8_encode($s); }
        function utf8_decode($s) { return \myFork\Symfony\Polyfill\Php_72\Php72::utf8_decode($s); }
    }
    if (!function_exists('spl_object_id')) {
        function spl_object_id($s) { return \myFork\Symfony\Polyfill\Php_72\Php72::spl_object_id($s); }
    }
    if (!defined('PHP_OS_FAMILY')) {
        define('PHP_OS_FAMILY', \myFork\Symfony\Polyfill\Php_72\Php72::php_os_family());
    }
}






if (!function_exists('http_parse_cookie')) {
	 function http_parse_cookie($cookie, $flags= 0, array $allowed_extras = null ){
	      return new \webfan\hps\Parse\Cookie($cookie, $flags,$allowed_extras); 
	 }
 }

class frdl_polyfill extends \stdclass
{
	const defined = true;
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$HOME/$WEBrpc.php" ; name="stub rpc.php"
Content-Type: application/x-httpd-php

<?php if ('POST' === $_SERVER['REQUEST_METHOD']) {
	 \Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->initialize()->index('/rpc/');
}else{
  header('Contant-Type: application/json');
  echo '{"jsonrpc":"2.0","error":{"code":-32700,"message":"Only http method `post` is allowed"},"id":null}';
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$HOME/$WEBstate.php" ; name="stub state.php"
Content-Type: application/x-httpd-php

<?php $state = [];

$state['webfan.app.fsm.user'] = \Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->initialize()->getContainer()->get('webfan.app.fsm.user')->getCurrentState()->getName(); 

if('admin'===$state['webfan.app.fsm.user']){
$state['webfan.app.fsm'] = \Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->getContainer()->get('webfan.app.fsm')->getCurrentState()->getName(); 


 $state['v'] = \Webfan\App\Shield::getInstance($this)->v; 
 $state['latest'] = \Webfan\App\Shield::getInstance($this)->latest; 
 $state['version'] = \Webfan\App\Shield::getInstance($this)->version; 
 $state['updateAvailable'] = \Webfan\App\Shield::getInstance($this)->updateAvailable; 
}


$state['baseUrlInstaller'] = 
(isset(\Webfan\App\Shield::getInstance($this)->config->baseUrlInstaller)) 
	? \Webfan\App\Shield::getInstance($this)->config->baseUrlInstaller 
	: rtrim(\webfan\hps\patch\Fs::getPathUrl($this->location), \DIRECTORY_SEPARATOR.'/ ').'/'.basename($_SERVER['PHP_SELF']);


$state['baseUrl'] = rtrim(\webfan\hps\patch\Fs::getPathUrl($this->location), \DIRECTORY_SEPARATOR.'/ ').'/';

if('admin'===$state['webfan.app.fsm.user']){

  $state['www_dir_requested'] = ltrim(\webfan\hps\patch\Fs::getRelativePath($_SERVER['DOCUMENT_ROOT'], __DIR__), '.');
}
$state['host'] = (isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];

$state['protocol'] = !empty($_SERVER['HTTPS']) ? 'https:' : 'http:';

if('admin'===$state['webfan.app.fsm.user']){
 if(isset(\Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->config->FRDLJS_PATH)) {
 $_p=\Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->config->FRDLJS_PATH;
 $_f = dirname(dirname($_p)).\DIRECTORY_SEPARATOR.'package.json';
   if(file_exists($_f)){
     $pkg = json_decode(file_get_contents($_f));
     $state['FrdlJsVersion'] = $pkg->version;
   }else{
     $state['FrdlJsVersion'] = '0.0.0';
   }
 }
}


 $state['emailState'] = -1;

 if(!isset(\Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->config->ADMIN_EMAIL) 
  || empty(\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL) 
  || ''===trim(\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL)
   || !isset(\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL_CONFIRMED)
   ) {
   $state['emailState'] = 0;
 }elseif(isset(\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL_CONFIRMED) && is_string(\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL_CONFIRMED) ){
     $state['emailState'] = 1;
 }elseif(isset(\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL) && !empty(\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL)
                   && isset(\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL_CONFIRMED) 
				   && true === isset(\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL_CONFIRMED)){
				         $state['emailState'] = 2;
				   }


header('Content-Type: application/json');
echo json_encode($state); ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$HOME/$WEBemail-confirm.php" ; name="stub email-confirm.php"
Content-Type: application/x-httpd-php

<?php if(isset($_REQUEST['code']) && isset(\Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->initialize()->config->ADMIN_EMAIL_CONFIRMED) 
    && $_REQUEST['code'] === \Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL_CONFIRMED){
	$config = \Webfan\App\Shield::getInstance($this)->config->export();
	$config['ADMIN_EMAIL_CONFIRMED'] = true;
	\Webfan\App\Shield::getInstance($this)->setConfig($config, true, true);	
	mail(\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL,
	"Your login was changed! (".\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL.")",
	"Your Admin login-name of your Frdlweb-Dashboard at ".\Webfan\App\Shield::getInstance($this)->config->baseUrlInstaller." was changed!
	
	From now on, please use your email `".\Webfan\App\Shield::getInstance($this)->config->ADMIN_EMAIL."` as login-username instead of `admin`!
	");
	echo 'Email confirmed';	
}else{
  echo 'Could not confirm an email!';
}


echo '<br /><a href="'.\Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->initialize()->config->baseUrlInstaller.'">Continue...</a>';
echo '<meta http-equiv="refresh" content="5; URL='.\Webfan\App\Shield::getInstance($this)->config->baseUrlInstaller .'">'; ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$HOME/$WEBlogout.php" ; name="stub logout.php"
Content-Type: application/x-httpd-php

<?php \Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->initialize()->session_destroy();

echo 'Good by!'; ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$HOME/$WEBterminal.php" ; name="stub terminal.php"
Content-Type: application/x-httpd-php

<?php if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$app = \Webfan\App\AppTerminalEmulatorKernel::create($_POST);
	$app();
}else{
$template = <<<TEMPLATE
<terminal-emulator  oc-lazy-load="['terminal-emulator']">
<div angular-terminal="workspace" greetings="$ loading frdl..." require-interpreter-module="angular-terminal/interpreter-frdl-default" 
  style="height:auto;max-height:320px;width:100%;position:relative;overflow:scroll;padding:0px;margin:0px;"></div> 
</terminal-emulator>
TEMPLATE;

echo $template;
} ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$HOME/$WEBlogin.php" ; name="stub login.php"
Content-Type: application/x-httpd-php

<?php \Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->initialize()->index('/login/'); ?>
--3333EVGuDPPT
Content-Disposition: "php" ; filename="$HOME/$WEBpoxy.php" ; name="stub poxy.php"
Content-Type: application/x-httpd-php

<?php \Webfan\App\Shield::getInstance($this, \frdl\i::c(), false)->initialize()->index('/proxy/'); ?>
--3333EVGuDPPT--
--hoHoBundary12344dh--
