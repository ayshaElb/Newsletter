<?php

namespace App\Command;
use Swift_Mailer;
use App\Entity\TypeNewsletter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendNewsletterCommand extends Command
{
    protected static $defaultName = 'send:newsletter';
    private $mailer;
    private $entityManager;

    /**
     * __construct
     *
     * @param Swift_Mailer $mailer
     * @param \Twig\Environment $templating
     * @return void
     */
    public function __construct(Swift_Mailer $mailer, \Twig\Environment $templating, EntityManagerInterface $entityManager)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    /**
     * configure
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setDescription('Command for send self newsletter')
            ->addArgument('id', InputArgument::REQUIRED, 'Id of the newsletter')

        ;
    }
    
    /**
     * execute
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        $output->writeln([
            'Command Send Self Newsletter',
            '============'
        ]);
        

        
        $newsletter = $this->entityManager->getRepository(TypeNewsletter::class)->find($input->getArgument('id'));
        $subscribers = $newsletter->getSubscribers();

        foreach ($subscribers as $key => $subscriber) {
            $message =(new \Swift_Message('Newsletter'))
            ->setFrom('societe@societe.com')
            ->setTo($subscriber->getEmail())
            ->setBody(
                $this->templating->render(
                    'emails/newsletter.html.twig',
                    [
                        'subscriber' => $subscriber,
                        'newsletter' => $newsletter,
                    ]
                    ),
                    'text/html'
            );
            
            $this->mailer->send($message);
            
        $output->writeln('Successful you send a self newsletter');
        
;
        }
        
    }
    
 
}