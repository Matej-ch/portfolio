<?php

namespace App\Command;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use App\Utils\Validator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use RuntimeException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Stopwatch\Stopwatch;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Create new admin user with this command',
)]
class CreateAdminCommand extends Command
{
    private SymfonyStyle $io;

    public function __construct(private readonly Validator                   $validator,
                                private readonly AdminRepository             $users,
                                private readonly UserPasswordHasherInterface $passwordHasher,
                                private readonly EntityManagerInterface      $entityManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('username', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('password', InputArgument::OPTIONAL, 'Your password')
            ->setHelp($this->getCommandHelp());
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        if (null !== $input->getArgument('email') && null !== $input->getArgument('username') && null !== $input->getArgument('password')) {
            return;
        }

        $this->io->title('Create New Admin Command Interactive Wizard');

        $this->io->text([
            'If you prefer to not use this interactive wizard, provide the',
            'arguments required by this command as follows:',
            '',
            ' $ php bin/console app:add-user email@example.com username password',
            '',
            'Now we\'ll ask you for the value of all the missing command arguments.',
        ]);

        $email = $input->getArgument('email');
        if (null !== $email) {
            $this->io->text(' > <info>Email</info>: ' . $email);
        } else {
            $email = $this->io->ask('Email', null, [$this->validator, 'validateEmail']);
            $input->setArgument('email', $email);
        }

        $name = $input->getArgument('username');
        if (null !== $name) {
            $this->io->text(' > <info>Username</info>: ' . $name);
        } else {
            $username = $this->io->ask('Name', null, [$this->validator, 'validateName']);
            $input->setArgument('name', $name);
        }

        $password = $input->getArgument('password');
        if (null !== $password) {
            $this->io->text(' > <info>Password</info>: *************');
        } else {
            $password = $this->io->askHidden('Password (your type will be hidden)', [$this->validator, 'validatePassword']);
            $input->setArgument('password', $password);
        }
    }

    private function validateUserData($name, $email, $plainPassword): void
    {
        $existingEmail = $this->users->findOneBy(['email' => $email]);

        if (null !== $existingEmail) {
            throw new RuntimeException(sprintf('There is already a user registered with the "%s" email.', $email));
        }

        $this->validator->validatePassword($plainPassword);
        $this->validator->validateEmail($email);
        $this->validator->validateName($name);

        $existingName = $this->users->findOneBy(['username' => $name]);

        if (null !== $existingName) {
            throw new RuntimeException(sprintf('There is already a user registered with the "%s" name.', $name));
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $stopwatch = new Stopwatch();
        $stopwatch->start('create-admin-command');

        $email = $input->getArgument('email');
        $name = $input->getArgument('username');
        $password = $input->getArgument('password');

        $this->validateUserData($name, $email, $password);

        $user = new Admin();
        $user->setUsername($name);
        $user->setEmail($email);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));
        $user->setIsVerified(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->io->success(sprintf('%s was successfully created: %s (%s)', 'Administrator user', $user->getUsername(), $user->getEmail()));

        $event = $stopwatch->stop('create-admin-command');
        if ($output->isVerbose()) {
            $this->io->comment(sprintf('New user database id: %d / Elapsed time: %.2f ms / Consumed memory: %.2f MB', $user->getId(), $event->getDuration(), $event->getMemory() / (1024 ** 2)));
        }

        return Command::SUCCESS;
    }

    private function getCommandHelp(): string
    {
        return <<<'HELP'
            The <info>%command.name%</info> command creates admin user and saves them in the database:
              <info>php %command.name%</info> <comment>email username password</comment>
            If you omit any of the three required arguments, the command will ask you to
            provide the missing values:
              # command will ask you for the email
              <info>php %command.name%</info> <comment>username password</comment>
              # command will ask you for the email and password
              <info>php %command.name%</info> <comment>username</comment>
              # command will ask you for all arguments
              <info>php %command.name%</info>
            HELP;
    }
}
