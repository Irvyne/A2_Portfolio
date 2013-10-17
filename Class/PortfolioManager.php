<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

class PortfolioManager
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param Portfolio $portfolio
     * @return bool
     */
    public function add(Portfolio $portfolio) {
        $sql = 'INSERT INTO portfolio (id, name, content, img, createdAt, updatedAt) VALUES (NULL, :name, :content, :img, :createdAt, :updatedAt)';
        $prepare = $this->pdo->prepare($sql);
        $query = $prepare->execute(array(
            'name'      => $portfolio->getName(),
            'content'   => $portfolio->getContent(),
            'img'       => $portfolio->getImg(),
            'createdAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s'),
        ));
        if ($query) {
            $portfolio->setId($this->pdo->lastInsertId());
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public function findAll() {
        $sql = "SELECT * FROM portfolio ORDER BY id DESC";
        $query = $this->pdo->query($sql);
        if ($query) {
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            $portfolioList = array();
            foreach ($results as $attributes) {
                $portfolioList[] = new Portfolio($attributes);
            }
            return $portfolioList;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return bool|Portfolio
     */
    public function find($id) {
        $sql = "SELECT * FROM portfolio WHERE id = :id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute(array(
            'id' => $id,
        ));
        $attributes = $prepare->fetch(PDO::FETCH_ASSOC);
        if ($attributes)
            return new Portfolio($attributes);
        else
            return false;
    }

    /**
     * @param Portfolio $portfolio
     * @return bool
     */
    public function update(Portfolio $portfolio) {
        $sql = "UPDATE portfolio SET name = :name, content = :content, img = :img, updatedAt = :updatedAt WHERE id = :id";
        $prepare = $this->pdo->prepare($sql);
        return $prepare->execute(array(
            'id'        => $portfolio->getId(),
            'name'      => $portfolio->getName(),
            'content'   => $portfolio->getContent(),
            'img'       => $portfolio->getImg(),
            'updatedAt' => date('Y-m-d H:i:s'),
        ));
    }

    /**
     * @param $parameter
     * @return PDOStatement
     */
    public function delete($parameter) {
        if ($parameter instanceof Portfolio) {
            $id = $parameter->getId();
        } else {
            $id = (int) $parameter;
        }
        $sql = "DELETE FROM portfolio WHERE id = ".$this->pdo->quote($id);
        return $this->pdo->query($sql);
    }
}