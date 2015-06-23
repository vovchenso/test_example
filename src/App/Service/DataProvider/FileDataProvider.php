<?php

namespace App\Service\DataProvider;

use App\Service\DataParser\DataParserInterface;

class FileDataProvider implements DataProviderInterface
{
    private $sPath;
    
    private $oParser = null;
    
    /**
     * @param string $path
     */
    public function __construct($path = null) 
    {
        if (null !== $path) {
            $this->setPath($path);
        }
    }
    

    /**
     * @param string $path
     * @throws \InvalidArgumentException
     * @return \App\Service\DataProvider\FileDataProvider
     */
    public function setPath($path)
    {
        if (!file_exists($path))
        {
            throw new \InvalidArgumentException(
                sprintf('File [%s] not found.', $path)
            );
        }
        
        if (!is_readable($path)) 
        {
            throw new \InvalidArgumentException(
                sprintf('File [%s] not readable.', $path)
            );
        }
        
        $this->sPath = $path;
        
        return $this;
    }
    
    /**
     * @param \App\Service\DataParser\DataParserInterface $parser
     * @return \App\Service\DataProvider\FileDataProvider
     * @throws \ErrorException
     */
    public function setParser(DataParserInterface $parser)
    {
        $this->oParser = $parser;
        return $this;
    }
    
    public function load()
    {
        if (null === $this->oParser)
        {
            throw new \ErrorException('Data parser is not set');
        }
        
        $sData = file_get_contents($this->sPath);
        
        return $this->oParser->parse($sData);
    }
}
