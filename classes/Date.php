<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 11.11.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Date Class
 */
class Date
{
    private int $date_id;
    private string $date;

    public function __construct()
    {
        $this->date = date('YmdHis');
    }

    /**
     * @return int
     */
    public function getDateId(): int
    {
        return $this->date_id;
    }

    /**
     * @param int $date_id
     */
    public function setDateId(int $date_id): void
    {
        $this->date_id = $date_id;
    }


    public function getYear()
    {
        return substr($this->date, 0, 4);
    }

    public function getMonth()
    {
        return substr($this->date,4, 2);
    }
    public function getDay(): string
    {
        return substr($this->date, 6, 2);
    }

    public function getHour()
    {
        return substr($this->date, 8, 2);
    }
    public function getMinute()
    {
        return substr($this->date, 10, 2);
    }
    public function getSecond()
    {
        return substr($this->date, 12, 2);
    }

    public function insertCurrentInfos()
    {
        try
        {
            $this->date = date('YmdHis');
            $check_count = DB::prepared('select * from date_dim');
            $check_count->execute();
            if($check_count->rowCount()==0)
            {
                $insert_id = DB::prepared('INSERT INTO date_dim(date_id, YEAR, MONTH, DAY, HOUR, MINUTE, SECOND) VALUES(0, :year,:month,:day,:hour,:minute,:second)');
                $insert_id->execute(array(
                    ":year"=>$this->getYear(),
                    ":month"=>$this->getMonth(),
                    ":day"=>$this->getDay(),
                    ":hour"=>$this->getHour(),
                    ":minute"=>$this->getMinute(),
                    ":second"=>$this->getSecond()
                ));
            }

            $stmt_id = DB::prepared('select max(date_id) from date_dim');
            $stmt_id->execute();

            $check_date = DB::prepared('select * from date_dim where YEAR=:year and month=:month and day=:day and hour=:hour and minute=:minute and second=:second');
            $check_date->execute(array(
                ":year"=>$this->getYear(),
                ":month"=>$this->getMonth(),
                ":day"=>$this->getDay(),
                ":hour"=>$this->getHour(),
                ":minute"=>$this->getMinute(),
                ":second"=>$this->getSecond()
            ));

            if($check_date->rowCount()==0)
            {
                echo "New Date [".$this->getDay(). " ". $this->getHour()." ".$this->getMinute()." ".$this->getSecond()." ]\n";
                $this->setDateId(++$stmt_id->fetch()[0]);
                $insert_id = DB::prepared('INSERT INTO date_dim(YEAR, MONTH, DAY, HOUR, MINUTE, SECOND) VALUES(:year,:month,:day,:hour,:minute,:second)');
                $insert_id->execute(array(
                    ":year"=>$this->getYear(),
                    ":month"=>$this->getMonth(),
                    ":day"=>$this->getDay(),
                    ":hour"=>$this->getHour(),
                    ":minute"=>$this->getMinute(),
                    ":second"=>$this->getSecond()
                ));
            }
            else
            {
                static $counter = 0;
                echo "Date Counter $counter\n";
                $counter++;
                $date_id = $check_date->fetch()[0];
                $this->setDateId($date_id);
            }


        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
        }
    }
}